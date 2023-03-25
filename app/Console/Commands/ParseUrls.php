<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\ItemURL;
use App\Models\WardrobeItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ParseUrls extends Command
{
    protected $signature = 'parse:urls';

    public function handle()
    {
        foreach (WardrobeItem::where('wardrobe_category_id', 84)->cursor() as $item) {
            $sex = $item->sex == 'unisex' ? 'male' : $item->sex;
            $res = Http::get("http://parser:5101/$sex/find/$item->name");

            if ($res->status() == 200) {
                $body = json_decode($res->body(), true);

                foreach ($body as $bodyItem) {
                    $brand = Brand::where('name', ucfirst($bodyItem['brand']))->first();
                    if (!$brand) {
                        $brand = Brand::create([
                            'name' => ucfirst($bodyItem['brand']),
                            'slug' => Str::slug($bodyItem['brand']),
                            'image' => ' '
                        ]);

                        $this->info("brand $brand->name created");
                    }

                    $url = ItemURL::create([
                        'url' => $bodyItem['url'],
                        'item_id' => $item->id,
                        'brand_id' => $brand->id
                    ]);

                    $this->info("url {$url->url} added");
                }
            }
        }


        return Command::SUCCESS;
    }
}
