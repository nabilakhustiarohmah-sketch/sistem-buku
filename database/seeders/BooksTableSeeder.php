<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'judul' => 'Belajar Laravel',
                'penulis' => 'Nabila',
                'tahun_terbit' => 2024,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pemrograman PHP Modern',
                'penulis' => 'Andi',
                'tahun_terbit' => 2023,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
