<?php

namespace App\Console\Commands;

use App\Models\ItemURL;
use Illuminate\Console\Command;

class FixUrls extends Command
{

    protected $signature = 'fix:urls';

    public function handle()
    {
        foreach (ItemURL::where('url', 'like', 's://%')->cursor() as $url) {
            $url->update([
                'url' => 'http' . $url->url
            ]);
        }

        return Command::SUCCESS;
    }
}
