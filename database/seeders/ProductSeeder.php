<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate(
            ['name' => 'Perangkat Jaringan'],
            [
                'description' =>
                    'Berisi perangkat jaringan untuk menghubungkan komputer dan perangkat lainnya.',
            ]
        );

        Product::firstOrCreate(
            ['sku' => 'RJ001'],
            [
                'category_id' => $category->id,
                'name' => 'Router Wi-Fi',
                'description' =>
                    'Perangkat jaringan yang digunakan untuk menghubungkan beberapa perangkat ke jaringan internet secara nirkabel melalui Wi-Fi.',
                'stock' => 8,
                'price' => 350000,
                'minimum_stock' => 3,
            ]
        );
    }
}
