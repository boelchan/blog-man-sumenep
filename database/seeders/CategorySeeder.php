<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['nama' => 'Banner', 'slug' => 'banner', 'is_primary' => 1],
            ['nama' => 'Pamflet', 'slug' => 'pamflet', 'is_primary' => 2],
        ]);
    }
}
