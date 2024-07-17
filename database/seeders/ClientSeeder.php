<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [];
        $clientAmount = 10;

        for ($i = 1; $i <= $clientAmount; $i++) {
            $clientData = [
                'email' => 'client' . $i . '@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            //Adds clientData at the end of clients
            $clients[] = $clientData;
        }

        DB::table('clients')->insert($clients);
    }
}
