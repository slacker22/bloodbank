<?php

use Illuminate\Database\Seeder;
use App\Requests;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requests = [
            [
                'patient_id'=>1,
                'blood_group_id'=>1,
                'product_type_id'=>1,
                'quantity'=>1,
                'priority'=>1,
                'required_date'=>'2020-08-01',
                'submitted_by'=> 4,
                'status'=>0
            ],
            [
                'patient_id'=>2,
                'blood_group_id'=>2,
                'product_type_id'=>2,
                'quantity'=>1,
                'priority'=>1,
                'required_date'=>'2020-08-01',
                'submitted_by'=> 4,
                'status'=>0
            ],
            [
                'patient_id'=>3,
                'blood_group_id'=>3,
                'product_type_id'=>3,
                'quantity'=>1,
                'priority'=>1,
                'required_date'=>'2020-08-01',
                'submitted_by'=> 4,
                'status'=>0
            ],


        ];

        foreach ($requests as $request) {
            Requests::create($request);
        }
    }
}
