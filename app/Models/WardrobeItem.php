<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WardrobeItem extends Model
{
    use HasFactory;

    protected $table = 'wardrobe_items';

    protected $fillable = [
        'name', 'slug', 'sex', 'wardrobe_category_id', 'image'
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(WardrobeCategory::class, 'wardrobe_category_id', 'id');
    }

    public function urls()
    {
        return $this->hasMany(ItemURL::class, 'item_id');
    }

}
