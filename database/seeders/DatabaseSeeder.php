<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categoryNames = [
            'Elektronik',
            'Fashion',
            'Aksesoris',
            'Peralatan Rumah',
            'Olahraga',
            'Buku',
            'Kecantikan',
        ];

        foreach ($categoryNames as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => 'Kategori ' . $name,
                ]
            );
        }

        $categoryIds = Category::pluck('id')->all();

        Product::factory()
            ->count(50)
            ->create()
            ->each(function (Product $product) use ($categoryIds) {
                $product->update([
                    'category_id' => fake()->randomElement($categoryIds),
                ]);
            });
    }
}