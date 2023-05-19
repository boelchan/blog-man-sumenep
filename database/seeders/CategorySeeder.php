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
            ['nama' => 'Gallery', 'slug' => 'gallery'],
            ['nama' => 'Pamflet', 'slug' => 'pamflet'],
            ['nama' => 'Banner', 'slug' => 'banner'],
            ['nama' => 'Artikel', 'slug' => 'artikel'],
            ['nama' => 'Informasi', 'slug' => 'informasi'],
        ]);
    }
}
