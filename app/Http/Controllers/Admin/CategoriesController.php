<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::whereNull('deleted_at')->orderByDesc('id')->paginate(20);

        return view('admin.looks.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.looks.categories.create');
    }


    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name'])
        ]);

        return redirect()->route('admin.looks.categories.show', $category);
    }


    public function show(Category $category)
    {
        return view('admin.looks.categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('admin.looks.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request['name'],
            'slug' => Str::slug($request['name'])
        ]);

        return redirect()->route('admin.looks.categories.show', $category);
    }


    public function destroy(Category $category)
    {
        //
    }
}
