<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WardrobeItem extends Model
{
    public const SEX_MALE = "male";
    public const SEX_FEMALE = "female";
    public const SEX_UNISEX = "unisex";

    protected $table = 'wardrobe_items';

    protected $fillable = [
        'name', 'slug', 'sex', 'wardrobe_category_id', 'image', 'tags'
    ];

    public $timestamps = false;

    public static function sexList() {
        return [
            self::SEX_MALE => 'Муж.',
            self::SEX_FEMALE => 'Жен.',
            self::SEX_UNISEX => 'Унисекс'
        ];
    }

    public function getSex() {
        return self::sexList()[$this->sex];
    }

    public function looks()
    {
        return $this->belongsToMany(Look::class, 'look_items', 'wardrobe_item_id', 'look_id');
    }

    public function category()
    {
        return $this->belongsTo(WardrobeCategory::class, 'wardrobe_category_id', 'id');
    }

    public function urls()
    {
        return $this->hasMany(ItemURL::class, 'item_id');
    }

}
