<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ItemURL;
use App\Models\WardrobeCategory;
use App\Models\WardrobeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class WardrobeController extends Controller
{

    public function index()
    {
        $items = WardrobeItem::with('category')->paginate(20);

        return view('admin.wardrobe-items.index', compact('items'));
    }


    public function create()
    {
        $categories = WardrobeCategory::all();
        return view('admin.wardrobe-items.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [

        ]);

        $item = WardrobeItem::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'wardrobe_category_id' => $request['category_id']
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
        return view('admin.wardrobe-items.edit', compact('item', 'categories'));
    }


    public function update(Request $request, WardrobeItem $item)
    {
        $item->update([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'wardrobe_category_id' => $request['category_id']
        ]);

        if ($request['image']) {
            \Storage::disk('public')->delete($item->image);

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
        //
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
