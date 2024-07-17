<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ordersDetail = [];
        $orderDetailAmount = 10;
        $maxRandomProductAmount = 6;

        for ($i = 1; $i <= $orderDetailAmount; $i++) {
            $orderDetailData = [
                'product_amount' => rand(1, $maxRandomProductAmount),
                'product_id' => $i,
                'shopping_cart_id' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            //Adds orderDetailData at the end of ordersDetail
            $ordersDetail[] = $orderDetailData;
        }

        DB::table('orders_detail')->insert($ordersDetail);
    }
}
