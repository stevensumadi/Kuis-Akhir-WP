<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Location;



class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = ['Tangerang', 'Singapore', 'Jakarta'];
        for ($i = 0 ; $i <=2; $i++){
            Location::create([
                'name' => $location[$i],
            ]);
        }
    }
}
