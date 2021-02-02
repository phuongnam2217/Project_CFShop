<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $menu->name = "Đồ uống";
        $menu->save();

        $menu = new Menu();
        $menu->name = "Đồ ăn";
        $menu->save();

        $menu = new Menu();
        $menu->name = "Khác";
        $menu->save();
    }
}
