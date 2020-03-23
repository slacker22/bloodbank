<?php

use Illuminate\Database\Seeder;
use App\BloodGroups;

class BloodGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['name' =>'O+'],
            ['name' =>'O-'],
            ['name' =>'A+'],
            ['name' =>'A-'],
            ['name' =>'B+'],
            ['name' =>'B-'],
            ['name' =>'AB+'],
            ['name' =>'AB-']
        ];

        foreach ($groups as $group) {
            BloodGroups::create($group);
        }
    }
}
