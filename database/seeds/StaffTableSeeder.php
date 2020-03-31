<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Artisan::call('passport:install --force');
        $users = [
            [
                'first_name'=>'admin',
                'last_name'=>'admin',
                'gender'=>1,
                'phone'=>'12345678919',
                'email'=>'admin@admin.com',
                'user_name'=>'admin.admin.1',
                'password'=>bcrypt('password'),
                'user_type_id'=>1,

            ],
            [
                'first_name'=>'bbstaff',
                'last_name'=>'bbstaff',
                'gender'=>1,
                'phone'=>'12345678928',
                'email'=>'bbstaff@bbstaff.com',
                'user_name'=>'bbstaff.bbstaff.2',
                'password'=>bcrypt('password'),
                'user_type_id'=>2,

            ],
            [
                'first_name'=>'hstaff',
                'last_name'=>'hstaff',
                'gender'=>1,
                'phone'=>'12345678937',
                'email'=>'hstaff@hstaff.com',
                'user_name'=>'hstaff.hstaff.3',
                'password'=>bcrypt('password'),
                'user_type_id'=>3,

            ],
            [
                'first_name'=>'doctor',
                'last_name'=>'doctor',
                'gender'=>1,
                'phone'=>'12345678946',
                'email'=>'doctor@doctor.com',
                'user_name'=>'doctor.doctor.4',
                'password'=>bcrypt('password'),
                'user_type_id'=>4,

            ]
        ];


        foreach ($users as $user) {
            $user = User::create($user);
            $user->staff()->create();
            $user->createToken('auth_token')->accessToken;
        }


    }
}
