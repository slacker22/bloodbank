<?php

use Illuminate\Database\Seeder;
use App\Viruses;

class VirusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viruses = [
            ['name' =>'HIV'],
            ['name' =>'Hepatitis A'],
            ['name' =>'Hepatitis B'],
            ['name' =>'Hepatitis C'],
            ['name' =>'H1N1']

        ];

        foreach ($viruses as $virus) {
            Viruses::create($virus);
        }
    }
}
