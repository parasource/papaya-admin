<?php

namespace App\Console\Commands;

use App\Models\ItemURL;
use Illuminate\Console\Command;

class FixUrls extends Command
{

    protected $signature = 'fix:urls';

    public function handle()
    {
        foreach (ItemURL::where('url', 'like', '%market%')->cursor() as $url) {
            $url = "https://" . substr($url, 4, strpos($url, "?") - 4);
            $this->info($url);
        }

        return Command::SUCCESS;
    }
}
