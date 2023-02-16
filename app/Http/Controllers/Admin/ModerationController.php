<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WardrobeItemDraft;
use Illuminate\Http\Request;

class ModerationController extends Controller
{
    public function step1()
    {
        $item = WardrobeItemDraft::where('status', WardrobeItemDraft::STATUS_DRAFT)->orderBy('id', 'DESC')->first();
        return view('admin.moderation.step1', compact('item'));
    }

    public function step1Approve(WardrobeItemDraft $item)
    {
        $item->update([
            'status' => WardrobeItemDraft::STATUS_APPROVED
        ]);

        return redirect()->route('admin.moderation-step-1.index');
    }

    public function step1Decline(WardrobeItemDraft $item)
    {
        $item->update([
            'status' => WardrobeItemDraft::STATUS_DECLINED
        ]);

        return redirect()->route('admin.moderation-step-1.index');
    }
}
