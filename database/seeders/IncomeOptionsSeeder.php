<?php

namespace Database\Seeders;

use App\Models\ExpendOptions;
use App\Models\IncomeOptions;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncomeOptions::create([
            'name' => 'ចំនូលលក់គម្រោងបាន',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        ExpendOptions::create([
            'name' => 'ចំណាយក្នុងរោងជាង',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        ExpendOptions::create([
            'name' => 'ចំណាយបង់ធានាគា +ផ្ទះ+ឈ្នួលរោងជាង',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        ExpendOptions::create([
            'name' => 'បង់លុយចំណាយSUPLIY',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        ExpendOptions::create([
            'name' => 'ចំណយប្រាក់ខែបុគ្គលិក',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        ExpendOptions::create([
            'name' => 'ចំណាយចាយទិញម្ហូបម៉ាក់ពេ+ប៉ាធា ចាក់សាំងក្នុងមួយខែ',
            'created_by' => 1,
            'updated_by' =>1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
