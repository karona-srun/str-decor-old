<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Product extends Model
{
    use HasFactory;
    
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }

    public function getProductCategory($id)
    {
        $item = ProductCategory::find($id);
        return $item['name'] ?? 'N/A';
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
}
