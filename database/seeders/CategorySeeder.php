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
            ['nama' => 'Profil', 'slug' => 'Profil'],
            ['nama' => 'Pamflet', 'slug' => 'pamflet'],
            ['nama' => 'Banner', 'slug' => 'banner'],
            ['nama' => 'Artikel', 'slug' => 'artikel'],
            ['nama' => 'Agenda', 'slug' => 'agenda'],
        ]);
    }
}
