<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{

    public function index()
    {
        $brands = Brand::all();

        return view('admin.brands.index', compact('brands'));
    }


    public function create()
    {
        return view('admin.brands.create');
    }


    public function store(Request $request)
    {
        $brand = Brand::create([
            'name' => $request['name'],
            'image' => $request['image']->store('brands', 'public')
        ]);

        return redirect()->route('admin.brands.show', $brand);
    }


    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }


    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }


    public function update(Request $request, Brand $brand)
    {
        $brand->update([
            'name' => $request['name']
        ]);

        if ($request['image']) {
            $brand->update([
                'image' => $request['image']->store('brands', 'public')
            ]);
        }

        return redirect()->route('admin.brands.show', $brand);
    }


    public function destroy(Brand $brand)
    {
        //
    }
}
