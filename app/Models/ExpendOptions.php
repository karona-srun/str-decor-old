<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpendOptions extends Model
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

    public function expends()
    {
        return $this->hasMany(Expend::class,'expend_option_id','id');
    }

}
