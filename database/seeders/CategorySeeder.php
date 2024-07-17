<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];
        $categoryAmount = 10;

        for ($i = 1; $i <= $categoryAmount; $i++) {
            $categoryData = [
                'name' => 'Category' . $i,
                'created_at' => now(),
                'updated_at' => now(),
                'enable' => boolval(random_int(0, 1)),
            ];
            //Adds categoryData at the end of categories
            $categories[] = $categoryData;
        }

        DB::table('categories')->insert($categories);
    }
}
