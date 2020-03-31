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
       $users = [
            [
                'first_name'=>'donor1',
                'last_name'=>'donor1',
                'gender'=>1,
                'phone'=>'11111111',
                'email'=>'donor1@donor.com',
                'user_name'=>'donor1.donor1.1',
                'password'=>bcrypt('password'),
                'user_type_id'=>5,

                'ssn'=>'111111111',
                'donor_type_id'=>2,
                'blood_group_id'=>1,

            ],

            [
                'first_name'=>'donor2',
                'last_name'=>'donor2',
                'gender'=>1,
                'phone'=>'222222222',
                'email'=>'donor2@donor.com',
                'user_name'=>'donor2.donor2.2',
                'password'=>bcrypt('password'),
                'user_type_id'=>5,

                'ssn'=>'22222222222',
                'donor_type_id'=>2,
                'blood_group_id'=>2,

            ],

           [
               'first_name'=>'donor3',
               'last_name'=>'donor3',
               'gender'=>1,
               'phone'=>'3333333333',
               'email'=>'donor3@donor.com',
               'user_name'=>'donor3.donor3.3',
               'password'=>bcrypt('password'),
               'user_type_id'=>5,

               'ssn'=>'3333333333333',
               'donor_type_id'=>2,
               'blood_group_id'=>3,

           ],




       ];


$user= User::create([
    'first_name'=>'donor1',
    'last_name'=>'donor1',
    'gender'=>1,
    'phone'=>'11111111',
    'email'=>'donor1@donor.com',
    'user_name'=>'donor1.donor1.1',
    'password'=>bcrypt('password'),
    'user_type_id'=>5,


]);
$user->donor()->create([

    'ssn'=>'111111111',
    'donor_type_id'=>2,
    'blood_group_id'=>1,
]);

        $user= User::create([
            'first_name'=>'donor2',
            'last_name'=>'donor2',
            'gender'=>1,
            'phone'=>'222222222',
            'email'=>'donor2@donor.com',
            'user_name'=>'donor2.donor2.2',
            'password'=>bcrypt('password'),
            'user_type_id'=>5,




        ]);
        $user->donor()->create([

            'ssn'=>'22222222222',
            'donor_type_id'=>2,
            'blood_group_id'=>2,
        ]);

        $user= User::create([
            'first_name'=>'donor3',
            'last_name'=>'donor3',
            'gender'=>1,
            'phone'=>'3333333333',
            'email'=>'donor3@donor.com',
            'user_name'=>'donor3.donor3.3',
            'password'=>bcrypt('password'),
            'user_type_id'=>5,






        ]);
        $user->donor()->create([

            'ssn'=>'3333333333333',
            'donor_type_id'=>2,
            'blood_group_id'=>3,
        ]);

//
//            foreach ($users as $user) {
//                //$filtered = collect($user)->only(['first_name','last_name','gender','phone','email','user_name','password','user_type_id'])->toArray();
//                $filtered = collect($user)->pull(['first_name','last_name','gender','phone','email','user_name','password','user_type_id'])->toArray();
//                dd($filtered);
//                $user = User::create($filtered);
//                $user->createToken('auth_token')->accessToken;
//                $filtered1 = collect($users)->only(['ssn','donor_type_id','blood_group_id'])->toArray();
//                //dd($filtered1);
//                $user->donor->create($filtered1);



//        }




    }
}
