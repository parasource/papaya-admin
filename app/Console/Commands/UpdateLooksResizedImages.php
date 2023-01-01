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
        $looks = Look::whereNotNull('deleted_at')->cursor();

        foreach ($looks as $look) {
            $image = Image::make('/var/www/storage' . $look->image);
            $image->resize(null, 750, function($constraint) {
                $constraint->aspectRatio();
            });
            $image->save('/var/www/storage/looks/resized/' . $image->filename . '.' . $image->extension);

            $look->update([
                'image_resized' => '/looks/resized' . $image->filename . '.' . $image->extension
            ]);
        }

        return 0;
    }
}
