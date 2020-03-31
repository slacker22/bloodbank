<?php

use App\DonorActivity;
use Illuminate\Database\Seeder;

class DonorActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            [
                'donor_id'=>1,
                'product_type_id'=>1,
                'temperature'=>'37',
                'weight'=>'80',
                'height'=>'180',
                'status'=> 1,
                'comments'=>'comments comments comments'
            ],
            [
                'donor_id'=>2,
                'product_type_id'=>2,
                'temperature'=>'37',
                'weight'=>'80',
                'height'=>'180',
                'status'=> 1,
                'comments'=>'comments comments comments'
            ],
            [
                'donor_id'=>3,
                'product_type_id'=>3,
                'temperature'=>'37',
                'weight'=>'80',
                'height'=>'180',
                'status'=> 1,
                'comments'=>'comments comments comments'
            ],


        ];

        foreach ($activities as $activity) {
            DonorActivity::create($activity);
        }
    }
}
