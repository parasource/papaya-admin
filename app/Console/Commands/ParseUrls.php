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
        foreach (WardrobeItem::cursor() as $item) {
            $res = Http::get("http://parser:5101/{$this->argument('sex')}/find/{$this->argument('query')}");

            if ($res->status() == 200) {
                $body = json_decode($res->body());

                $brand = Brand::where('name', ucfirst($item->category->id));
                if (!$brand) {
                    $brand = Brand::create([
                        'name' => ucfirst($body['brand']),
                        'slug' => Str::slug($body['brand']),
                        'image' => ' '
                    ]);

                    $this->info("brand $brand->name created");
                }

                $url = ItemURL::create([
                    'url' => $body['url'],
                    'item_id' => $item->id,
                    'brand_id' => $brand->id
                ]);

                $this->info("url {$url->url} added");
            }
        }


        return Command::SUCCESS;
    }
}
