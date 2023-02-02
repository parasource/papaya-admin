<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ItemURL;
use App\Models\WardrobeCategory;
use App\Models\WardrobeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class WardrobeController extends Controller
{
    public function index(Request $request)
    {
        $categories = WardrobeCategory::all()->sortBy('name');

        $query = WardrobeItem::orderByDesc('id')->withCount('urls');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }
        if (!empty($value = $request->get('sex'))) {
            $query->where('sex', $value);
        }
        if (!empty($value = $request->get('category_id'))) {
            $query->where('wardrobe_category_id', $value);
        }

        $items = $query->paginate(20);

        $sexList = [
            'male' => 'Муж.',
            'female' => 'Жен.',
            'unisex' => 'Унисекс'
        ];

        return view('admin.wardrobe-items.index', compact('items', 'categories', 'sexList'));
    }


    public function create()
    {
        $categories = WardrobeCategory::all();
        $sex = WardrobeItem::sexList();
        return view('admin.wardrobe-items.create', compact('categories', 'sex'));
    }


    public function store(Request $request)
    {
        $categories = WardrobeCategory::pluck('id')->toArray();

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', Rule::in(array_keys(WardrobeItem::sexList()))],
            'category_id' => ['required', 'numeric', Rule::in($categories)],
            'image' => ['required', 'image', 'max:10240', 'mimes:webp,png,jpg,jpeg'],
            'tags' => ['required', 'string', 'max:500']
        ]);

        $item = WardrobeItem::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'sex' => $request['sex'],
            'wardrobe_category_id' => $request['category_id'],
            'tags' => $request['tags']
        ]);

        $image = $request['image'];
        $file = $image->store('wardrobe', 'public');
        $filename = md5($image->getClientOriginalName() . time());

        $image = Image::make($image);

        $image->encode('webp', 100)->resize(null, 700, function ($constraint) {
            $constraint->aspectRatio();
        })->save('/var/www/storage/wardrobe/' . $filename . '.webp');

        Storage::disk('public')->delete($file);

        $item->update([
            'image' => '/wardrobe/' . $filename . '.webp',
        ]);

        return redirect()->route('admin.wardrobe-items.show', $item);
    }


    public function show(WardrobeItem $item)
    {
        return view('admin.wardrobe-items.show', compact('item'));
    }


    public function edit(WardrobeItem $item)
    {
        $categories = WardrobeCategory::all();
        $sex = WardrobeItem::sexList();
        return view('admin.wardrobe-items.edit', compact('item', 'categories', 'sex'));
    }


    public function update(Request $request, WardrobeItem $item)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', Rule::in(array_keys(WardrobeItem::sexList()))],
            'category_id' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:10240', 'mimes:webp,png,jpg,jpeg'],
            'tags' => ['required', 'string', 'max:500'],
        ]);

        $item->update([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'sex' => $request['sex'],
            'wardrobe_category_id' => $request['category_id'],
            'tags' => $request['tags']
        ]);

        if ($request['image']) {
            Storage::disk('public')->delete($item->image);

            $image = $request['image'];
            $file = $image->store('wardrobe', 'public');
            $filename = md5($image->getClientOriginalName() . time());

            $image = Image::make($image);

            $image->encode('webp', 100)->resize(null, 700, function ($constraint) {
                $constraint->aspectRatio();
            })->save('/var/www/storage/wardrobe/' . $filename . '.webp');

            Storage::disk('public')->delete($file);

            $item->update([
                'image' => '/wardrobe/' . $filename . '.webp',
            ]);
        }

        return redirect()->route('admin.wardrobe-items.show', $item);
    }


    public function destroy(WardrobeItem $item)
    {
        if (!Gate::check('admin', Auth::user())) {
            abort(403);
        }

        $item->looks()->detach();
        foreach ($item->urls as $url) {
            $url->delete();
        }

        $item->delete();

        return redirect()->route('admin.wardrobe-items.index');
    }

    /////////////
    // URLS

    public function addUrlView(WardrobeItem $item)
    {
        $brands = Brand::all();
        return view('admin.wardrobe-items.add-url', compact('item', 'brands'));
    }

    public function addUrl(Request $request, WardrobeItem $item)
    {
        $item->urls()->create([
            'brand_id' => $request['brand_id'],
            'url' => $request['url']
        ]);

        return redirect()->route('admin.wardrobe-items.show', $item);
    }

    public function removeUrl(WardrobeItem $item, ItemURL $url)
    {
        $url->delete();

        return redirect()->back();
    }
}
