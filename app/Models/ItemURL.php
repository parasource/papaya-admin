<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemURL extends Model
{
    use HasFactory;

    protected $table = 'item_urls';

    protected $fillable = [
        'url', 'item_id', 'brand_id'
    ];

    public function item()
    {
        return $this->belongsTo(WardrobeItem::class, 'item_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
