<?php

use Illuminate\Database\Seeder;
use App\UserTypes;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $types = [
            ['name' =>'admin'],
            ['name' =>'blood_bank_staff'],
            ['name' =>'hospital_staff'],
            ['name' =>'doctor'],
            ['name' =>'donor'],

            ];

        foreach ($types as $type) {
            UserTypes::create($type);
        }


    }
}
