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
        $this->call([
            //UsersTableSeeder::class,
            UserTypesTableSeeder::class,
            DonorTypesTableSeeder::class,
            BloodGroupsTableSeeder::class,
            ProductTypesTableSeeder::class,
            VirusesTableSeeder::class,
            StorageLocationsTableSeeder::class,
            StaffTableSeeder::class,
            DonorsTableSeeder::class,
            DonorActivitiesTableSeeder::class,

            BloodProductsTableTableSeeder::class,
            PatientsTableSeeder::class,
            RequestsTableSeeder::class,
            HandledRequestsTableSeeder::class

        ]);


    }
}
