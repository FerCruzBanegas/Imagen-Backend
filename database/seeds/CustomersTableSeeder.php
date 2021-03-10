<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i=1; $i <= 2000; $i++){
            Customer::create([
               'business_name' => $faker->company,
               'contact' => $faker->name,
               'address' => $faker->address,
               'nit' => $faker->randomNumber,
               'phone' => $faker->phoneNumber,
               'email' => $faker->email,
               'city_id'=> $faker->numberBetween(1, 9),
            ]);
        }
    }
}
