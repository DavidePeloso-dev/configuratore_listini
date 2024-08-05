<?php

namespace Database\Seeders;

use App\Models\Thickness;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThicknessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $thicknesses = [18, 30];
        foreach ($thicknesses as $thickness) {
            $thick = new Thickness();
            $thick->value = $thickness;
            $thick->catalog_id = 1;
            $thick->save();
        }
    }
}
