<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Donors;

class DonorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user= User::create([
            'first_name'=>'donor1',
            'last_name'=>'donor1',
            'gender'=>1,
            'phone'=>'01006815084',
            'email'=>'donor1@donor.com',
            'user_name'=>'donor1.donor1.1',
            'password'=>bcrypt('password'),
            'user_type_id'=>5,


        ]);
        $user->donor()->create([

            'ssn'=>'29504111804524',
            'donor_type_id'=>2,
            'blood_group_id'=>1,
        ]);

        $user= User::create([
            'first_name'=>'donor2',
            'last_name'=>'donor2',
            'gender'=>1,
            'phone'=>'01006815085',
            'email'=>'donor2@donor.com',
            'user_name'=>'donor2.donor2.2',
            'password'=>bcrypt('password'),
            'user_type_id'=>5,




        ]);
        $user->donor()->create([

            'ssn'=>'29504111804525',
            'donor_type_id'=>2,
            'blood_group_id'=>2,
        ]);

        $user= User::create([
            'first_name'=>'donor3',
            'last_name'=>'donor3',
            'gender'=>1,
            'phone'=>'01006815086',
            'email'=>'donor3@donor.com',
            'user_name'=>'donor3.donor3.3',
            'password'=>bcrypt('password'),
            'user_type_id'=>5,






        ]);
        $user->donor()->create([

            'ssn'=>'29504111804526',
            'donor_type_id'=>2,
            'blood_group_id'=>3,
        ]);




    }
}
