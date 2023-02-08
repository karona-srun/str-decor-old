<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expend extends Model
{
    use HasFactory;

    public function expendOptions()
    {
        return $this->belongsTo(ExpendOptions::class,'expend_option_id');
    }

    public function sumTotalAmount($id, $start_date, $end_date){
        return Expend::where('expend_option_id', $id)->whereBetween('date', array($start_date,$end_date))->sum('amount');
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
