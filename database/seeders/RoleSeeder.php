<?php

namespace Database\Seeders;

use App\Constants\RoleConstant;
use App\Models\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Roles();
        $role->id = RoleConstant::ROLE_ADMIN;
        $role->name = "ADMIN";
        $role->save();

        $role = new Roles();
        $role->id = RoleConstant::ROLE_STOCKER;
        $role->name = "STOCKER";
        $role->save();

        $role = new Roles();
        $role->id = RoleConstant::ROLE_CASHIER;
        $role->name = "CASHIER";
        $role->save();
    }
}
