<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WardrobeCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WardrobeCategoriesController extends Controller
{

    public function index()
    {
        $categories = WardrobeCategory::whereNull('deleted_at')->paginate(20);

        return view('admin.wardrobe-categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.wardrobe-categories.create');
    }


    public function store(Request $request)
    {
        $wardrobeCategory = WardrobeCategory::create([
           'name' => $request['name'],
           'slug' => Str::slug($request['name']),
            'parent_category' => $request['parent_category']
        ]);

        return redirect()->route('admin.wardrobe-categories.show', $wardrobeCategory);
    }


    public function show(WardrobeCategory $wardrobeCategory)
    {
        return view('admin.wardrobe-categories.show', compact('wardrobeCategory'));
    }


    public function edit(WardrobeCategory $wardrobeCategory)
    {
        return view('admin.wardrobe-categories.edit', compact('wardrobeCategory'));
    }


    public function update(Request $request, WardrobeCategory $wardrobeCategory)
    {
        $wardrobeCategory->update([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'parent_category' => $request['parent_category']
        ]);

        return redirect()->route('admin.wardrobe-categories.show', $wardrobeCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WardrobeCategory  $wardrobeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WardrobeCategory $wardrobeCategory)
    {
        $wardrobeCategory->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('admin.wardrobe-categories.index');
    }
}
