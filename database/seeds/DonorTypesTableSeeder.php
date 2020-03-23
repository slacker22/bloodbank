<?php

use Illuminate\Database\Seeder;
use App\DonorTypes;

class DonorTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' =>'student'],
            ['name' =>'external'],

        ];

        foreach ($types as $type) {
            DonorTypes::create($type);
        }
    }
}
