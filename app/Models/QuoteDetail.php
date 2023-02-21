<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteDetail extends Model
{
    use HasFactory;

    public function productes() 
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
