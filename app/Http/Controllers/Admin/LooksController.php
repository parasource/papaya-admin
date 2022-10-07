<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Look;
use App\Models\WardrobeCategory;
use App\Models\WardrobeItem;
use App\Services\Adviser;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.looks.create', compact('categories'));
    }


    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {
            $look = Look::create([
                'name' => $request['name'],
                'slug' => Str::slug($request['name']),
                'image' => $request['image']->store('looks', 'public')
            ]);

            $filename = md5($image->getClientOriginalName() . time());

            $image = Image::make($image);

            $watermark = Image::make(public_path('/images/watermark.png'));
            $image->insert($watermark, 'center');

            $image->encode('webp', 80)->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('storage/profiles/' . $filename . '.webp'));

            Storage::disk('public')->delete($file);

            $profile->images()->create([
                'file' => '/storage/profiles/' . $filename . '.webp'
            ]);

            foreach ($request['categories'] as $id) {
                $look->categories()->attach($id);
            }

            $this->adviser->storeItem($look, $request['categories']);

            return redirect()->route('admin.looks.show', $look);
        });


        return redirect()->route('admin.looks.index');
    }


    public function show(Look $look)
    {
        return view('admin.looks.show', compact('look'));
    }


    public function edit(Look $look)
    {
        $categories = Category::all();
        return view('admin.looks.edit', compact('look', 'categories'));
    }


    public function update(Request $request, Look $look)
    {
        DB::transaction(function () use ($request, $look) {
            $look->update([
                'name' => $request['name'],
                'slug' => Str::slug($request['name']),
                'desc' => $request['desc']
            ]);

            if ($request['image']) {
                \Storage::disk('public')->delete($look->image);
                $look->update([
                    'image' => $request['image']->store('looks', 'public')
                ]);
            }

            // detaching previous records
            foreach ($look->categories as $c) {
                $look->categories()->detach($c->id);
            }
            foreach ($request['categories'] as $id) {
                $look->categories()->attach($id);
            }

            $this->adviser->storeItem($look, $request['categories']);

        });

        return redirect()->route('admin.looks.show', $look);
    }

    public function destroy(Look $look)
    {
        $look->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('admin.looks.index');
    }

    public function addItems(Request $request, Look $look)
    {
        $categories = WardrobeCategory::all();

        $ids = $look->items()->pluck('wardrobe_items.id')->toArray();
        $query = WardrobeItem::orderByDesc('id')->whereNotIn('id', $ids);

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
