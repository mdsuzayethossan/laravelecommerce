<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;
    function color(){

        return $this->belongsTo(color::class, 'color_id');
    }
    function size(){

        return $this->belongsTo(size::class, 'size_id');
    }
}
