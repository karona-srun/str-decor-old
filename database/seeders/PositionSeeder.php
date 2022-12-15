<?php

namespace Database\Seeders;

use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'name' => 'Admin',
            'note' => 'Full accessible',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Position::create([
            'name' => 'Account',
            'note' => 'Limit accessible',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Position::create([
            'name' => 'Staff',
            'note' => 'Any accessible',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
