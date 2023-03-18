<?php

namespace App\Console\Commands;

use App\Models\ItemURL;
use Illuminate\Console\Command;

class FixUrls extends Command
{

    protected $signature = 'fix:urls';

    public function handle()
    {
        foreach (ItemURL::where('url', 'like', '%redav%')->cursor() as $url) {
            $leftHalf = "https://" . substr($url->url, strpos($url, "https://"), strlen($url->url) - strpos($url, "?"));
            $urlStr = substr($leftHalf, 0, strpos($leftHalf, "&subid"));
            $this->info($urlStr);
        }

        return Command::SUCCESS;
    }
}
