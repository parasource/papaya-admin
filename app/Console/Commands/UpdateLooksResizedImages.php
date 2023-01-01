<?php

namespace App\Console\Commands;

use App\Models\Look;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;

class UpdateLooksResizedImages extends Command
{

    protected $signature = 'looks:resized';

    public function handle()
    {
        foreach (Look::whereNull('deleted_at')->whereNotNull('image')->cursor() as $look) {
            $this->info("reading image from path: " . '/var/www/storage' . $look->image);
            $image = Image::make('/var/www/storage' . $look->image);
            $image->resize(null, 750, function($constraint) {
                $constraint->aspectRatio();
            });
            $this->info("saving resized image to path: " . '/var/www/storage/looks/resized/' . $image->filename . '.' . $image->extension);
            $image->save('/var/www/storage/looks/resized/' . $image->filename . '.' . $image->extension);

            $look->update([
                'image_resized' => '/looks/resized/' . $image->filename . '.' . $image->extension
            ]);
        }

        return 0;
    }
}
