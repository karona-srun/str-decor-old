<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    use HasFactory;

    protected $table = 'sale_orders'; 

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function scopeCreatedToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeCreatedThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month);
    }

}
