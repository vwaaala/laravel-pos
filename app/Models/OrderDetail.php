<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price', 'total_amount', 'discount'];
}
