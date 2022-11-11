<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Look;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $looks = Look::withCount('items')->get();
        $looksWithoutItems = $looks->where('items_count', 0)->count();
        $looksWithNotEnoughItems = $looks->where('items_count', '>', 0)->where('items_count', '<', 4)->count();
        $looksWithItems = $looks->where('items_count', '>=', 4)->count();

        return view('admin.index', compact('looksWithoutItems', 'looksWithNotEnoughItems', 'looksWithItems'));
    }
}
