<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Look;
use App\Models\WardrobeCategory;
use App\Models\WardrobeItem;
use App\Services\Adviser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class LooksController extends Controller
{
    private $adviser;

    public function __construct(Adviser $adviser)
    {
        $this->adviser = $adviser;
    }

    public function index(Request $request)
    {
        $query = Look::whereNull('deleted_at')->orderBy('id', 'desc');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }
        if (!empty($value = $request->get('desc'))) {
            $query->where('desc', 'like', '%' . $value . '%');
        }
        $looks = $query->paginate(20);

        return view('admin.looks.index', compact('looks'));
    }


    public function create()
    {
        $categories = Category::all();
        $sex = Look::sexList();
        $seasons = Look::seasonsList();
        return view('admin.looks.create', compact('categories', 'sex', 'seasons'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'max:1000'],
            'sex' => ['required', 'string', Rule::in(array_keys(Look::sexList()))],
            'season' => ['required', 'string', Rule::in(array_keys(Look::seasonsList()))],
            'image' => ['required', 'image', 'max:10240', 'mimes:webp,png,jpg,jpeg']
        ]);
        if (count($request['categories']) == 0) {
            throw ValidationException::withMessages([
                'categories' => 'At least one category is required'
            ]);
        }

        $rand = rand(1000, 9999);
        $look = Look::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']) . "-$rand",
            'desc' => $request['desc'],
            'sex' => $request['sex'],
            'season' => $request['season']
        ]);

        foreach ($request['categories'] as $id) {
            $look->categories()->attach($id);
        }

        $categories = [
            $look->sex,
            $look->season,
        ];
        foreach ($look->categories as $category) {
            $categories[] = $category->slug;
        }

        $image = $request['image'];
        $file = $image->store('looks', 'public');
        $filename = md5($image->getClientOriginalName() . time());

        $image = Image::make($image);

        $image->encode('webp')->save('/var/www/storage/looks/' . $filename . '.webp');
        $image->resize(null, 750, function($constraint) {
            $constraint->aspectRatio();
        })->encode('webp')->save('/var/www/storage/looks/resized/' . $filename . '.webp');

        Storage::disk('public')->delete($file);

        $look->update([
            'image_ratio' => $this->decToFraction($image->getWidth() / $image->getHeight()),
            'image' => '/looks/' . $filename . '.webp',
            'image_resized' => '/looks/resized/' . $filename . '.webp'
        ]);

        $this->adviser->storeItem($look, $categories);


        return redirect()->route('admin.looks.show', $look);
    }

    private function decToFraction($float) {
        // 1/2, 1/4, 1/8, 1/16, 1/3 ,2/3, 3/4, 3/8, 5/8, 7/8, 3/16, 5/16, 7/16,
        // 9/16, 11/16, 13/16, 15/16
        $whole = floor ( $float );
        $decimal = $float - $whole;
        $leastCommonDenom = 48; // 16 * 3;
        $denominators = array (2, 3, 4, 8, 16, 24, 48 );
        $roundedDecimal = round ( $decimal * $leastCommonDenom ) / $leastCommonDenom;
        if ($roundedDecimal == 0)
            return $whole;
        if ($roundedDecimal == 1)
            return $whole + 1;
        foreach ( $denominators as $d ) {
            if ($roundedDecimal * $d == floor ( $roundedDecimal * $d )) {
                $denom = $d;
                break;
            }
        }
        return ($whole == 0 ? '' : $whole) . " " . ($roundedDecimal * $denom) . "/" . $denom;
    }


    public function show(Look $look)
    {
        return view('admin.looks.show', compact('look'));
    }


    public function edit(Look $look)
    {
        $categories = Category::all();
        $sex = Look::sexList();
        $seasons = Look::seasonsList();
        return view('admin.looks.edit', compact('look', 'categories', 'sex', 'seasons'));
    }


    public function update(Request $request, Look $look)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'max:1000'],
            'sex' => ['required', 'string', Rule::in(array_keys(Look::sexList()))],
            'season' => ['required', 'string', Rule::in(array_keys(Look::seasonsList()))],
            'image' => ['nullable', 'image', 'max:10240', 'mimes:webp,png,jpg,jpeg']
        ]);
        if (count($request['categories']) == 0) {
            throw ValidationException::withMessages([
                'categories' => 'At least one category is required'
            ]);
        }

        $look->update([
            'name' => $request['name'],
            'desc' => $request['desc'],
            'sex' => $request['sex'],
            'season' => $request['season'],
        ]);

        if ($request['image']) {
            @\Storage::disk('public')->delete('/var/www/storage'.$look->image);

            $image = $request['image'];
            $file = $image->store('looks', 'public');
            $filename = md5($image->getClientOriginalName() . time());

            $image = Image::make($image);

            $image->encode('webp')->save('/var/www/storage/looks/' . $filename . '.webp');

            $look->update([
                'image_ratio' => $this->decToFraction($image->getWidth() / $image->getHeight())
            ]);

            Storage::disk('public')->delete($file);

            $look->update([
                'image' => '/looks/' . $filename . '.webp',
            ]);
        }

        // detaching previous records
        foreach ($look->categories as $c) {
            $look->categories()->detach($c->id);
        }
        foreach ($request['categories'] as $id) {
            $look->categories()->attach($id);
        }

        $categories = [
            $look->sex,
            $look->season,
        ];
        foreach ($look->categories as $category) {
            $categories[] = $category->slug;
        }

        $this->adviser->storeItem($look, $categories);

        return redirect()->route('admin.looks.show', $look);
    }

    public function destroy(Look $look)
    {
        if (!Gate::check('admin', Auth::user())) {
            abort(403);
        }

        $look->update([
            'deleted_at' => Carbon::now()
        ]);

        $this->adviser->deleteItem($look);

        return redirect()->route('admin.looks.index');
    }

    public function addItems(Request $request, Look $look)
    {
        $categories = WardrobeCategory::all();

        $ids = $look->items()->pluck('wardrobe_items.id')->toArray();
        $query = WardrobeItem::orderByDesc('id')
            ->whereIn('sex', [$look->sex, 'unisex'])->whereNotIn('id', $ids);

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }
        if (!empty($value = $request->get('category_id'))) {
            $query->where('wardrobe_category_id', $value);
        }

        $items = $query->paginate(20);

        return view('admin.looks.add-item', compact('items', 'look', 'categories'));
    }

    public function addItem(Look $look, WardrobeItem $item)
    {
        $look->items()->attach($item->id);

        return redirect()->back();
    }

    public function removeItem(Look $look, WardrobeItem $item)
    {
        $look->items()->detach($item->id);

        return redirect()->back();
    }
}
