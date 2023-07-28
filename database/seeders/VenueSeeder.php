<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Venue;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0 ; $i <=9; $i++){
            Venue::create([
               'location_id' => mt_rand(1,3),
               'name' => $faker->company(),
               'location' => $faker->sentence(2),
               'price' => $faker->numberBetween($min = 1000, $max = 10000),
               'description' => $faker->sentence(20)
            ]);
        }
    }
}
