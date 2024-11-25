<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::insert([
            ['nama' => 'Kesehatan', 'slug' => 'kesehatan'],
            ['nama' => 'Ibu & Anak', 'slug' => 'ibu-anak'],
        ]);
    }
}
