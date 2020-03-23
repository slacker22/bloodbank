<?php

use Illuminate\Database\Seeder;
use App\ProductTypes;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' =>'whole blood'],
            ['name' =>'plasma'],
            ['name' =>'platelet']

        ];

        foreach ($types as $type) {
            ProductTypes::create($type);
        }
    }
}
