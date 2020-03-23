<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->integer('gender');
			$table->string('phone')->unique();
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
            $table->string('user_name')->unique();
            $table->string('password');
            $table->unsignedBigInteger('user_type_id');
			$table->foreign('user_type_id')->references('id')->on('user_types');
			$table->rememberToken();
			$table->timestamps();

        });

        Artisan::call('db:seed',[
            '--class' => UsersTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
