<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(TimeSeeder::class);
        $this->call(WorkPlaceSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(IncomeOptionsSeeder::class);
    }
}
