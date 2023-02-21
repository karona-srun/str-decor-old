<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    public function customer() 
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function quoteDetail() 
    {
        return $this->hasMany(QuoteDetail::class,'quotes_id','id');
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
