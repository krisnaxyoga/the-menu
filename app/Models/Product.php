<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function categoryproduct() {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
