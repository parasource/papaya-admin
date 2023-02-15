<?php

namespace App\Console\Commands;

use App\Models\WardrobeItemDraft;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;

class ImportWardrobeItems extends Command
{

    protected $signature = 'wardrobe:import {category}';

    public function handle()
    {
        $path = "/var/www/storage/";
        $category = $this->argument("category");

        $files = array_diff(scandir($path . $category), array('.', '..'));

        foreach ($files as $fileName) {
            [$sex, $tmpName] = explode(":", $fileName);
            $name = explode(".", $tmpName)[0];

            $item = WardrobeItemDraft::make([
                'name' => $name,
                'sex' => $sex === 'men' ? 'male' : 'female',
                'status' => WardrobeItemDraft::STATUS_DRAFT,
            ]);

            $imageName = md5($fileName . time());

            $fullPath = $path . $category . "/" . $fileName;

            $image = Image::make($fullPath);
            $image->encode('webp', 100)->flip()
                ->save('/var/www/storage/wardrobe/' . $imageName . '.webp');

            $item->image = '/wardrobe/' . $imageName . '.webp';

            $item->save();

            $this->info('item added: ' . $name);
        }

        $this->info('successfully imported all items');

        return Command::SUCCESS;
    }
}
