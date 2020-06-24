<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorActivitiesVirusesPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donor_activity_viruses', function (Blueprint $table) {
            //$table->id();
            $table->bigIncrements('id');
            $table->unsignedBigInteger('donor_activity_id');
            $table->foreign('donor_activity_id')->references('id')->on('donor_activities');
            $table->unsignedBigInteger('viruses_id');
            $table->foreign('viruses_id')->references('id')->on('viruses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donor_activities_viruses_pivot');
    }
}
