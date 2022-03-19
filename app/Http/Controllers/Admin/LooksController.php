<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Look;
use Illuminate\Http\Request;

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
        //
    }


    public function show(Look $look)
    {
        //
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
