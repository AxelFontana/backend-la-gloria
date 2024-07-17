<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $shoppingCarts = [];
        $shoppingCartAmount = 10;
        $maxRandomPrice = 100000;

        $today = strtotime(date('Y-m-d'));

        for ($i = 1; $i <= $shoppingCartAmount; $i++) {
            $randomPrice = rand(100, $maxRandomPrice);

            //Random date between January 1, 1970 (Unix epoch) and current date
            $randomDate = date('Y-m-d', rand(1, $today));

            $shoppingCartData = [
                'total_price' => $randomPrice,
                'date' => $randomDate,
                'client_id' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            //Adds orderData at the end of orders
            $shoppingCarts[] = $shoppingCartData;
        }

        DB::table('shopping_carts')->insert($shoppingCarts);
    }
}
