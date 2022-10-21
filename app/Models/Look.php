<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Look extends Model
{
    use HasFactory;

    public const SEX_MALE = "male";
    public const SEX_FEMALE = "female";

    protected $table = "looks";

    protected $fillable = [
        'name', 'slug', 'image', 'desc', 'created_at', 'updated_at', 'deleted_at', 'sex'
    ];

    public $timestamps = true;

    public static function sexList() {
        return [
            self::SEX_MALE => 'Муж.',
            self::SEX_FEMALE => 'Жен.'
        ];
    }

    public function getSex() {
        return self::sexList()[$this->sex];
    }

    public function items()
    {
        return $this->belongsToMany(WardrobeItem::class, 'look_items', 'look_id', 'wardrobe_item_id');
    }

    public function topics()
    {
        return $this->belongsToMany(Look::class, 'topic_looks', 'look_id', 'topic_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'look_tags', 'look_id', 'tag_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'look_categories', 'look_id', 'category_id');
    }
}
