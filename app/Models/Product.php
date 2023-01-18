<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_image'];
    function inventories() {
        return $this->hasMany(inventory::class, 'product_id');
    }
}
