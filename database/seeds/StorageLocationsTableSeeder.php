<?php

use Illuminate\Database\Seeder;
use App\StorageLocation;

class StorageLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            ['name' =>'Fridge 1'],
            ['name' =>'Fridge 2'],
            ['name' =>'Fridge 3'],
            ['name' =>'Fridge 4'],
            ['name' =>'Fridge 5'],
            ['name' =>'Fridge 6'],
            ['name' =>'Fridge 7'],
            ['name' =>'Fridge 8'],
            ['name' =>'Fridge 9'],
            ['name' =>'Fridge 10'],

        ];

        foreach ($locations as $location) {
            StorageLocation::create($location);
        }
    }
}
