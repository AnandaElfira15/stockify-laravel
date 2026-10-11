<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ImportP4ProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat kategori P4 jika belum tersedia.
        $categoryNames = [
            'Aksesoris Komputer',
            'Audio',
            'Kabel',
            'Penyimpanan',
            'pc',
        ];

        $categories = [];

        foreach ($categoryNames as $name) {
            $category = Category::firstOrCreate(
                ['name' => $name],
                ['description' => 'Kategori produk dari proyek P4']
            );

            $categories[$name] = $category->id;
        }

        // Data produk disalin berdasarkan data yang terlihat di phpMyAdmin.
        $products = [
            [
                'sku' => 'MS001',
                'name' => 'Mouse Wireless',
                'category_id' => $categories['Aksesoris Komputer'],
                'price' => 150000,
                'stock' => 11,
                'minimum_stock' => 5,
            ],
            [
                'sku' => 'HS001',
                'name' => 'Headset Gaming',
                'category_id' => $categories['Audio'],
                'price' => 275000,
                'stock' => 3,
                'minimum_stock' => 3,
            ],
            [
                'sku' => 'SP001',
                'name' => 'Speaker Bluetooth',
                'category_id' => $categories['Audio'],
                'price' => 220000,
                'stock' => 6,
                'minimum_stock' => 3,
            ],
            [
                'sku' => 'UC001',
                'name' => 'USB Cable',
                'category_id' => $categories['Kabel'],
                'price' => 45000,
                'stock' => 20,
                'minimum_stock' => 5,
            ],
            [
                'sku' => 'FD002',
                'name' => 'Laptop',
                'category_id' => $categories['Penyimpanan'],
                'price' => 5000000,
                'stock' => 19,
                'minimum_stock' => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }
    }
}
