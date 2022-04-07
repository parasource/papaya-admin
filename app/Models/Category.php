<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = true;
    protected $table = 'categories';
    protected $fillable = [
        'name'
    ];

    public function looks()
    {
        return $this->belongsToMany(Look::class, 'look_categories', 'category_id', 'look_id');
    }
}
