<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit = new Unit();
        $unit->name = "Gam";
        $unit->save();

        $unit = new Unit();
        $unit->name = "Kg";
        $unit->save();

        $unit = new Unit();
        $unit->name = "Lon";
        $unit->save();

        $unit = new Unit();
        $unit->name = "Hộp";
        $unit->save();

        $unit = new Unit();
        $unit->name = "Thùng";
        $unit->save();

        $unit = new Unit();
        $unit->name = "Lốc";
        $unit->save();

        $unit = new Unit();
        $unit->name = "Lít";
        $unit->save();

        $unit = new Unit();
        $unit->name = "Ml";
        $unit->save();
    }
}
