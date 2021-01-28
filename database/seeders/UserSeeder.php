<?php

namespace Database\Seeders;

use App\Constants\RoleConstant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'admin';
        $user->username = 'admin';
        $user->email = 'admin@gmail.com';
        $user->phone = '0123456789';
        $user->role_id = RoleConstant::ROLE_ADMIN;
        $user->password = Hash::make('123456');
        $user->save();
    }
}
