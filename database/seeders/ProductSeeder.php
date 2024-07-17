<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Ball',
                'size' => 'Medium',
                'image' => 'https://vvivrtywfxzzjrnepzmm.supabase.co/storage/v1/object/public/placeholderproducts/ball.jpg',
                'price' => 1999,
                'stock' => 10,
                'brand_id' => 1,
                'category_id' => 1,
                'enable' => true,
            ],
            [
                'name' => 'Sport Pants',
                'size' => 'L',
                'image' => 'https://vvivrtywfxzzjrnepzmm.supabase.co/storage/v1/object/public/placeholderproducts/pants.jpg',
                'price' => 2499,
                'stock' => 5,
                'brand_id' => 1,
                'category_id' => 2,
                'enable' => true,
            ],
            [
                'name' => 'Sport Shirt',
                'size' => 'S',
                'image' => 'https://vvivrtywfxzzjrnepzmm.supabase.co/storage/v1/object/public/placeholderproducts/shirt.jpg',
                'price' => 1499,
                'stock' => 8,
                'brand_id' => 1,
                'category_id' => 3,
                'enable' => true,
            ],
            [
                'name' => 'Sport shoes type A',
                'size' => '42',
                'image' => 'https://vvivrtywfxzzjrnepzmm.supabase.co/storage/v1/object/public/placeholderproducts/shoes2.jpg',
                'price' => 2999,
                'stock' => 3,
                'brand_id' => 2,
                'category_id' => 4,
                'enable' => true,
            ],
            [
                'name' => 'Sport Shoes Type B',
                'size' => '40',
                'image' => 'https://vvivrtywfxzzjrnepzmm.supabase.co/storage/v1/object/public/placeholderproducts/shoes3.jpg',
                'price' => 2199,
                'stock' => 12,
                'brand_id' => 1,
                'category_id' => 4,
                'enable' => true,
            ],
            [
                'name' => 'Sport Shoes Type C',
                'size' => '41',
                'image' => 'https://vvivrtywfxzzjrnepzmm.supabase.co/storage/v1/object/public/placeholderproducts/shoes4.jpg',
                'price' => 2699,
                'stock' => 7,
                'brand_id' => 2,
                'category_id' => 5,
                'enable' => true,
            ],
            [
                'name' => 'Sport Shoes Type C',
                'size' => '39',
                'image' => 'https://vvivrtywfxzzjrnepzmm.supabase.co/storage/v1/object/public/placeholderproducts/shoes5.webp',
                'price' => 1699,
                'stock' => 10,
                'brand_id' => 1,
                'category_id' => 2,
                'enable' => true,
            ],
            [
                'name' => 'Ball 2',
                'size' => 'Small',
                'image' => 'https://vvivrtywfxzzjrnepzmm.supabase.co/storage/v1/object/public/placeholderproducts/ball.jpg',
                'price' => 3199,
                'stock' => 4,
                'brand_id' => 2,
                'category_id' => 1,
                'enable' => true,
            ],
            [
                'name' => 'Sport Pants Type B',
                'size' => 'M',
                'image' => 'https://vvivrtywfxzzjrnepzmm.supabase.co/storage/v1/object/public/placeholderproducts/pants.jpg',
                'price' => 2399,
                'stock' => 9,
                'brand_id' => 1,
                'category_id' => 2,
                'enable' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        Product::factory()->count(20)->create();
    }
}
