<?php

use App\BloodProducts;
use Illuminate\Database\Seeder;

class BloodProductsTableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'barcode'=>'345656546',
                'blood_group_id'=>1,
                'product_type_id'=>1,
                'storage_location_id'=>1,
                'donor_activity_id'=>1,
                'expire_on'=>'2020-08-01 07:30:46',

            ],
            [
                'barcode'=>'345456666',
                'blood_group_id'=>2,
                'product_type_id'=>2,
                'storage_location_id'=>2,
                'donor_activity_id'=>2,
                'expire_on'=>'2020-08-01 07:30:46',

            ],
            [
                'barcode'=>'3666667777',
                'blood_group_id'=>3,
                'product_type_id'=>3,
                'storage_location_id'=>3,
                'donor_activity_id'=>3,
                'expire_on'=>'2020-07-21 07:30:46',

            ],
            [
                'barcode'=>'3678945621',
                'blood_group_id'=>1,
                'product_type_id'=>1,
                'storage_location_id'=>1,
                'donor_activity_id'=>1,
                'expire_on'=>'2020-07-21 07:30:46',

            ],


        ];

        foreach ($products as $product) {
            BloodProducts::create($product);
        }
    }
}
