<?php

namespace App\Console\Commands;

use App\Models\Look;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;

class UpdateLooksImageRatios extends Command
{

    protected $signature = 'looks:ratios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update looks image ratios';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $looks = Look::whereNull('deleted_at')->get();
        foreach ($looks as $look) {
            $path = "/var/www/storage".$look->image;
            $image = Image::make($path);
            $this->info("updating ratio for image ".$path);

            $ratio = $this->decToFraction($image->getWidth() / $image->getHeight());
            $this->info("- ratio is ".$ratio);
            $look->update([
                'image_ratio' => $ratio
            ]);
        }

        $this->info("successfully updated ratios");

        return 0;
    }

    private function decToFraction($float) {
        // 1/2, 1/4, 1/8, 1/16, 1/3 ,2/3, 3/4, 3/8, 5/8, 7/8, 3/16, 5/16, 7/16,
        // 9/16, 11/16, 13/16, 15/16
        $whole = floor ( $float );
        $decimal = $float - $whole;
        $leastCommonDenom = 48; // 16 * 3;
        $denominators = array (2, 3, 4, 8, 16, 24, 48 );
        $roundedDecimal = round ( $decimal * $leastCommonDenom ) / $leastCommonDenom;
        if ($roundedDecimal == 0)
            return $whole;
        if ($roundedDecimal == 1)
            return $whole + 1;
        foreach ( $denominators as $d ) {
            if ($roundedDecimal * $d == floor ( $roundedDecimal * $d )) {
                $denom = $d;
                break;
            }
        }
        return ($whole == 0 ? '' : $whole) . " " . ($roundedDecimal * $denom) . "/" . $denom;
    }
}
