<?php

namespace App\Console\Commands;

use App\Models\WardrobeCategory;
use App\Models\WardrobeItem;
use App\Models\WardrobeItemDraft;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportNewWardrobe extends Command
{
    protected $signature = 'new_wardrobe:import';

    public function handle()
    {
        foreach (WardrobeItemDraft::where('status', WardrobeItemDraft::STATUS_APPROVED)->cursor() as $draftItem) {
            $category = WardrobeCategory::where('name', $draftItem->category)->first();
            if (!$category) {
                $category = WardrobeCategory::create([
                    'name' => $draftItem->category,
                    'slug' => Str::slug($draftItem->category),
                    'parent_category' => ' '
                ]);
                $this->info("category {$category->name} created");
            }

            $item = WardrobeItem::create([
                'name' => $draftItem->name,
                'slug' => Str::slug($draftItem->name) . "-" . rand(111, 999),
                'wardrobe_category_id' => $category->id,
                'image' => $draftItem->image,
                'sex' => $draftItem->sex,
                'tags' => ' '
            ]);

            $this->info("item {$item->name} imported");
        }

        return Command::SUCCESS;
    }
}
