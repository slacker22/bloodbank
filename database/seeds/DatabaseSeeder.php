<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserTypesTableSeeder::class);
        $this->call(DonorTypesTableSeeder::class);
        $this->call(BloodGroupsTableSeeder::class);
        $this->call(ProductTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);




    }
}
