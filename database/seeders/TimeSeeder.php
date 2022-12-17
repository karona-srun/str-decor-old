<?php

namespace Database\Seeders;

use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Time::create([
            'name' => 'Morning',
            'start_time' => '8:00:00',
            'end_time' => '12:00:00',
            'note' => 'Working at morning',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Time::create([
            'name' => 'Afternoon',
            'start_time' => '13:00:00',
            'end_time' => '17:00:00',
            'note' => 'Working at afternoon',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Time::create([
            'name' => 'Full day',
            'start_time' => '8:00:00',
            'end_time' => '17:00:00',
            'note' => 'Working at full day',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
