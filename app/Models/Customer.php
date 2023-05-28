<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
  
    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function order_details() {
        return $this->hasMany(OrderDetails::class);
    }

    public function table() {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
