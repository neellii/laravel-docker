<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_products';

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function order()
    {
        return  $this->belongsTo(Order::class);
    }

    public function product()
    {
        return  $this->belongsTo(Product::class);
    }
}
