<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Artisan;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install --force');
        $user = User::create([
            'first_name'=>'admin',
            'last_name'=>'admin',
            'gender'=>'1',
            'phone'=>'1234567891',
            'email'=>'admin@admin.com',
            'user_name'=>'admin.admin.1',
            'password'=>bcrypt('password'),
            'user_type_id'=>'1',

        ]);

         $user->createToken('auth_token')->accessToken;
    }
}
