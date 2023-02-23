<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Look;
use App\Models\WardrobeItemDraft;

class HomeController extends Controller
{
    public function index() {
        $maleLooksQuery = Look::where('sex', Look::SEX_MALE)->withCount('items')->get();
        $maleLooks = [
            'without_items' => $maleLooksQuery->where('items_count', 0)->count(),
            'with_not_enough_items' => $maleLooksQuery->where('items_count', '>', 0)->where('items_count', '<', 4)->count(),
            'with_items' => $maleLooksQuery->where('items_count', '>=', 4)->count()
        ];

        $femaleLooksQuery = Look::where('sex', Look::SEX_FEMALE)->withCount('items')->get();
        $femaleLooks = [
            'without_items' => $femaleLooksQuery->where('items_count', 0)->count(),
            'with_not_enough_items' => $femaleLooksQuery->where('items_count', '>', 0)->where('items_count', '<', 4)->count(),
            'with_items' => $femaleLooksQuery->where('items_count', '>=', 4)->count()
        ];

        $topLooks = Look::whereNull('deleted_at')->withCount('likes')->orderBy('likes_count')->limit(3)->get();
        $itemsModeration = [
            'yes' => WardrobeItemDraft::where('status', '!=', WardrobeItemDraft::STATUS_DRAFT)->count(),
            'no' => WardrobeItemDraft::where('status', WardrobeItemDraft::STATUS_DRAFT)->count()
        ];

        return view('admin.index', compact('maleLooks', 'femaleLooks', 'topLooks', 'itemsModeration'));
    }
}
