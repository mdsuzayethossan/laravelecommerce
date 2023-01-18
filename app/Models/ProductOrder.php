<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class ProductOrder extends Model
{
    use HasFactory;
    function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    function order(){
        return $this->belongsTo(order::class, 'order_id');
    }
}
