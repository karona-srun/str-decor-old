<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public function staff()
    {
        return $this->belongsTo(StaffInfo::class,'staff_id');
    }

    public function sumAttendanceFilter($id, $startDate, $endDate)
    {
        return Attendance::where('staff_id',$id)->whereBetween('date', [$startDate, $endDate])->sum('num_hour');
    }

    public function sumAttendance($id)
    {
        return Attendance::where('staff_id',$id)->sum('num_hour');
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
