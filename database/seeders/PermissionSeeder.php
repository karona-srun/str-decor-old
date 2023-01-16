<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Dashboard',
            'Dashboard Sale',
            'Customer List',
            'Customer Create',
            'Customer Edit',
            'Customer Delete',
            'Staff List',
            'Staff Create',
            'Staff Edit',
            'Staff Delete',
            'Position List',
            'Position Create',
            'Position Edit',
            'Position Delete',
            'WorkPlace List',
            'WorkPlace Create',
            'WorkPlace Edit',
            'WorkPlace Delete',
            'Payroll List',
            'Payroll Create',
            'Payroll Edit',
            'Payroll Delete',
            'Attandance List',
            'Attandance Create',
            'Attandance Edit',
            'Attandance Delete',
            'Sale List',
            'Sale Create',
            'Sale Edit',
            'Sale Delete',
            'Product Category List',
            'Product Category Create',
            'Product Category Edit',
            'Product Category Delete',
            'Product List',
            'Product Create',
            'Product Edit',
            'Product Delete',
            'Income List',
            'Income Create',
            'Income Edit',
            'Income Delete',
            'Expend List',
            'Expend Create',
            'Expend Edit',
            'Expend Delete',
            'User List',
            'User Create',
            'User Edit',
            'User Delete',
            'Role List',
            'Role Create',
            'Role Edit',
            'Role Delete',
            'Option Income List',
            'Option Income Create',
            'Option Income Edit',
            'Option Income Delete',
            'Option Expend List',
            'Option Expend Create',
            'Option Expend Edit',
            'Option Expend Delete',
            'Time List',
            'Time Create',
            'Time Edit',
            'Time Delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
