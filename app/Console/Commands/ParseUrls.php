<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ParseUrls extends Command
{

    protected $signature = 'parse:urls {sex} {query}';

    public function handle()
    {
        $res = Http::get("http://parser:5101/{$this->argument('sex')}/find/{$this->argument('query')}");

        if ($res->status() == 200) {
            $this->info($res->body());
        }

        return Command::SUCCESS;
    }
}
