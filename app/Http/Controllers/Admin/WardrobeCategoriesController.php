<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WardrobeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WardrobeCategoriesController extends Controller
{

    public function index()
    {
        $categories = WardrobeCategory::all();

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
           'slug' => Str::slug($request['name'])
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
            'slug' => Str::slug($request['name'])
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
        //
    }
}
