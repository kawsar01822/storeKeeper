<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransactionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $productId = DB::table('products')->insertGetId([
                'name' => $faker->word,
                'price' => $faker->randomFloat(2, 1, 100),
                'quantity' => $faker->numberBetween(1, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('transactions')->insert([
                'product_id' => $productId,
                'quantity_sold' => $faker->numberBetween(1, 50),
                'total_amount' => $faker->randomFloat(2, 10, 500),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
