<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Hash;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 0; $i < 15; $i++) {
            DB::table('items')->insert([
                'name' => 'name' . Str::random(3),
                'details' => 'details' . Str::random(25),
                'currency' => 'EGP',
                'price' => 150,
                'created_at' => '2023-09-03 18:12:03',
                'updated_at' => '2023-09-03 18:12:03',
            ]);
            DB::table('customers')->insert([
                'name' => 'name' . Str::random(3),
                'company' => 'company' . Str::random(4),
                'cPerson' => 'cPerson' . Str::random(4),
                'address' => 'address' . Str::random(4),
                'city' => 'city' . Str::random(3),
                'state' => 'state' . Str::random(3),
                'posCode' => Str::random(4),
                'country' => 'country' . Str::random(2),
                'email' => Str::random(4) . '@gmail.com',
                'phone_number' => "+201069780368",
                'created_at' => '2023-09-03 18:12:03',
                'updated_at' => '2023-09-03 18:12:03',
            ]);
        }
    }
}
