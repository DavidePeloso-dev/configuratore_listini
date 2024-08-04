<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['elemento a spalla', 'letto', 'letto con inserto', 'armadio scorrevole'];

        foreach ($categories as $cate) {
            $cat = new Category();
            $cat->name = $cate;
            $cat->slug = Str::slug($cate, '-');
            $cat->catalog_id = 1;
            $cat->save();
        }
    }
}
