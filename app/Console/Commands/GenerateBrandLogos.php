<?php

namespace App\Console\Commands;

use App\Models\Brand;
use Illuminate\Console\Command;
use Image;

class GenerateBrandLogos extends Command
{

    protected $signature = 'brands:logo';

    public function handle()
    {
        $width = 1000;
        $height = 1000;
        $center_x = $width / 2;
        $center_y = $height / 2;
        $max_len = 20;
        $font_size = 102;
        $font_height = 50;
        $img = Image::canvas($width, $height, '#ffffff');

        foreach (Brand::where('image', ' ')->cursor() as $brand) {
            $text = $brand->name;

            $filename = md5($brand->name . time()) . ".webp";
            $lines = explode("\n", wordwrap($text, $max_len));
            $y = $center_y - ((count($lines) - 1) * $font_height);
            foreach ($lines as $line) {
                $img->text($line, $center_x, $y, function ($font) use ($font_size) {
                    $font->file(public_path('fonts/Arial.ttf'));
                    $font->size($font_size);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('middle');
                    $font->angle(0);
                });
                $y += $font_height * 2;
            }

            $img->save("/var/www/storage/brands/" . $filename);
            $brand->update([
                'image' => 'brands/' . $filename
            ]);
        }
        return Command::SUCCESS;
    }
}
