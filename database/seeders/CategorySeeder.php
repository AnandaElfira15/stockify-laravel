<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Aksesoris Komputer',
                'description' => 'Berisi aksesoris komputer seperti mouse.',
            ],
            [
                'name' => 'Audio',
                'description' => 'Berisi perangkat audio seperti headset dan speaker.',
            ],
            [
                'name' => 'Kabel',
                'description' => 'Berisi kabel untuk perangkat elektronik.',
            ],
            [
                'name' => 'Penyimpanan',
                'description' => 'Berisi perangkat untuk menyimpan data.',
            ],
            [
                'name' => 'pc',
                'description' => 'Berisi perangkat dan perlengkapan komputer.',
            ],
            [
                'name' => 'Perangkat Jaringan',
                'description' => 'Berisi perangkat jaringan untuk menghubungkan komputer dan perangkat lainnya.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
