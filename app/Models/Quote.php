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

    public function submitBy()
    {
        return $this->belongsTo(User::class, 'submit_by');
    }

    public function approveBy()
    {
        return $this->belongsTo(User::class, 'approve_by');
    }

    public function status($status)
    {
        switch ($status) {
            case '0':
                $resp = __('app.status_submit'); 
                break;
            case '1':
                $resp = __('app.status_panding'); 
                break;
            case '2':
                $resp = __('app.status_verify'); 
                break;
            case '3':
                $resp = __('app.status_rejected'); 
                break;
            case '4':
                $resp = __('app.status_approved'); 
                break;
            default:
                $resp = __('app.status_submit'); 
                break;
        }
        return $resp;
    }

    public function colorStatus($status)
    {
        switch ($status) {
            case '0':
                $color = 'badge-primary'; 
                break;
            case '1':
                $color = 'badge-info';
                break;
            case '2':
                $color = 'badge-secondary'; 
                break;
            case '3':
                $color = 'badge-danger';  
                break;
            case '4':
                $color = 'badge-success'; 
                break;
            default:
                $color = 'badge-primary'; 
                break;
        }
        return $color;
    }
}
