<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i=1; $i <= 20; $i++){
            Product::create([
               'name' => $faker->company,
               'dimension' => $faker->randomElement(['12 x 6', '10 x 6', '10 x 4', '8 x 6', '8 x 4', '6 x 4']),
               'description' => $faker->text,
               'category_id'=> $faker->numberBetween(1, 3),
            ]);
        }
    }
}
