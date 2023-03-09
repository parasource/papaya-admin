<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WardrobeItemDraft;

class ModerationController extends Controller
{
    public function step1()
    {
        $item = WardrobeItemDraft::where('status', WardrobeItemDraft::STATUS_APPROVED)->orderBy('id', 'ASC')->first();
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

    public function step1Approved()
    {
        $items = WardrobeItemDraft::where('status', WardrobeItemDraft::STATUS_APPROVED)
            ->orderBy('updated_at', 'DESC')
            ->paginate();
        return view('admin.moderation.step1-approved', compact('items'));
    }
}
