<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WardrobeCategory extends Model
{
    use HasFactory;

    protected $table = 'wardrobe_categories';

    protected $fillable = [
        'name', 'slug', 'parent_category'
    ];

    public $timestamps = true;


    public function items() {
        return $this->hasMany(WardrobeItem::class, 'wardrobe_category_id', 'id');
    }
}
