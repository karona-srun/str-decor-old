<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class StaffInfo extends Model
{
    use HasFactory;

    protected $appends = ['full_name','full_name_kh'];

    public function getFullNameAttribute() {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function getFullNameKhAttribute() {
        return $this->last_name_kh.' '.$this->first_name_kh;
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class,'staff_id')->where('status', 'presence');
    }

    public function sumAttendance($id)
    {
        return Attendance::where('staff_id',$id)->sum('num_hour');
    }

    public function positions()
    {
        return $this->belongsTo(Position::class,'position');
    }

    public function worktime()
    {
        return $this->belongsTo(Time::class,'work_time');
    }

    public function workplaces()
    {
        return $this->belongsTo(Workplace::class,'work_place');
    }
}
