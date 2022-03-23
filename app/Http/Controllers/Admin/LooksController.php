<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Look;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LooksController extends Controller
{

    public function index()
    {
        $looks = Look::whereNull('deleted_at')->orderBy('id', 'desc')->paginate(20);
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
            'image' => $request['image']->store('looks', 'public')
        ]);

        return redirect()->route('admin.looks.show', $look);
    }


    public function show(Look $look)
    {
        return view('admin.looks.show', compact('look'));
    }


    public function edit(Look $look)
    {
        return view('admin.looks.edit', compact('look'));
    }


    public function update(Request $request, Look $look)
    {
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

        return redirect()->route('admin.looks.show', $look);
    }


    public function destroy(Look $look)
    {
        $look->update([
           'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('admin.looks.index');
    }
}
