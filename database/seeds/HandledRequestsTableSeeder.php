<?php

use App\HandledRequests;
use Illuminate\Database\Seeder;

class HandledRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handledRequests = [
            [
                'request_id'=>1,
                'blood_product_id'=>1,
                'handled_by'=>2,
            ],
            [
                'request_id'=>2,
                'blood_product_id'=>2,
                'handled_by'=>2,
            ],
            [
                'request_id'=>3,
                'blood_product_id'=>3,
                'handled_by'=>2,
            ],


        ];

        foreach ($handledRequests as $handledRequest) {
            HandledRequests::create($handledRequest);
        }
    }
}
