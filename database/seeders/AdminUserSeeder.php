<?php

namespace Database\Seeders;

use App\Models\SystemProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Karona', 
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $role = Role::create(['name' => 'Administrator']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);

        SystemProfile::create([
            'name' => 'STR Decor', 
            'email' => 'admin@gmail.com',
            'tel' => '000000000',
            'photo' => 'logo.jpg',
            'address' => 'Phnom Penh, Cambodia',
            'descrip_contract' => 'testing condition',
        ]);
    }
}
