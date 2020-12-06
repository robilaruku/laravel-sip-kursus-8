<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }
}
