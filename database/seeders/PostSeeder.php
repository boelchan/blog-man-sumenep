<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        Post::insert([
            [
                'uuid' => $faker->uuid(),
                'kategori_id' => '1',
                'judul' => 'Visi misi',
                'slug' => Str::slug('Visi misi'),
                'konten' => $faker->paragraph(50),
            ],
            [
                'uuid' => $faker->uuid(),
                'kategori_id' => '1',
                'judul' => 'Sejarah',
                'slug' => Str::slug('Sejarah'),
                'konten' => $faker->paragraph(50),
            ],
        ]);
    }
}
