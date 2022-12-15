<?php

namespace Database\Seeders;

use App\Models\Workplace;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Workplace::create([
            'name' => 'Office',
            'status' => true,
            'note' => 'Working at Office',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Workplace::create([
            'name' => 'Outside',
            'status' => true,
            'note' => 'Working at Outside',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
