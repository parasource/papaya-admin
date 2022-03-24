<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WardrobeCategory;
use App\Models\WardrobeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $item = WardrobeItem::create([
            'name' => $request['name'],
            'image' => $request['image']->store('wardrobe', 'public'),
            'slug' => Str::slug($request['name']),
            'wardrobe_category_id' => $request['category_id']
        ]);

        return redirect()->route('admin.wardrobe-items.show', $item);
    }


    public function show(WardrobeItem $wardrobeItem)
    {
        return view('admin.wardrobe-items.show', compact('wardrobeItem'));
    }


    public function edit(WardrobeItem $wardrobeItem)
    {
        $categories = WardrobeCategory::all();
        return view('admin.wardrobe-items.edit', compact('wardrobeItem', 'categories'));
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
            $item->update([
                'image' => $request['image']->store('wardrobe', 'public'),
            ]);
        }

        return redirect()->route('admin.wardrobe-items.show', $item);
    }


    public function destroy(WardrobeItem $wardrobeItem)
    {
        //
    }
}
