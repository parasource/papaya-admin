<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Look;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $maleLooks = Look::where('sex', Look::SEX_MALE)->withCount('items')->get();
        $maleLooksWithoutItems = $maleLooks->where('items_count', 0)->count();
        $maleLooksWithNotEnoughItems = $maleLooks->where('items_count', '>', 0)->where('items_count', '<', 4)->count();
        $maleLooksWithItems = $maleLooks->where('items_count', '>=', 4)->count();

        $femaleLooks = Look::where('sex', Look::SEX_FEMALE)->withCount('items')->get();
        $femaleLooksWithoutItems = $femaleLooks->where('items_count', 0)->count();
        $femaleLooksWithNotEnoughItems = $femaleLooks->where('items_count', '>', 0)->where('items_count', '<', 4)->count();
        $femaleLooksWithItems = $femaleLooks->where('items_count', '>=', 4)->count();

        return view('admin.index', compact('maleLooksWithoutItems', 'maleLooksWithNotEnoughItems', 'maleLooksWithItems',
                                                        'femaleLooksWithoutItems', 'femaleLooksWithNotEnoughItems', 'femaleLooksWithItems'));
    }
}
