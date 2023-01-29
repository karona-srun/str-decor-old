<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    // public function setCreatedAtAttribute( $value ) {
    //     $this->attributes['created_at'] = (new Carbon($value))->format('d-m-Y h:i:s A');
    // }

    // public function setUpdatedAtAttribute( $value ) {
    //     $this->attributes['updated_at'] = (new Carbon($value))->format('d-m-Y h:i:s A');
    // }
}
