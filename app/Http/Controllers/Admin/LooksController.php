<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Look;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LooksController extends Controller
{

    public function index()
    {
        $looks = Look::whereNull('deleted_at')->paginate(20);
        return view('admin.looks.index', compact('looks'));
    }


    public function create()
    {
        return view('admin.looks.create');
    }


    public function store(Request $request)
    {
        $look = Look::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'image' => $request['image']->store('papaya', 'looks')
        ]);

        return redirect()->route('admin.looks.index');
    }


    public function show(Look $look)
    {
        return view('admin.looks.show', compact('look'));
    }


    public function edit(Look $look)
    {
        //
    }


    public function update(Request $request, Look $look)
    {
        //
    }


    public function destroy(Look $look)
    {
        //
    }
}
