<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->mediumIncrements('doctor_id');
            $table->tinyInteger('speciality_id')->unsigned();
            $table->enum('prefix', ['Dr.', 'Dt.', 'Mr.', 'Ms.', 'Mrs.']);
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('medical_registration_number', 50);
            $table->string('referral_code', 20)->nullable();
            $table->string('clinic_name');
            $table->smallInteger('clinic_fees')->unsigned()->default(0);
            $table->string('clinic_phone', 15)->nullable();
            $table->string('clinic_city')->nullable();
            $table->string('clinic_locality')->nullable();
            $table->smallInteger('online_fees')->unsigned()->default(0);
            $table->tinyInteger('experience')->unsigned()->default(0);
            $table->string('qualifications')->nullable();
            $table->longText('personal_statement')->nullable();
            $table->float('clinic_latitude', 8, 6)->nullable();
            $table->float('clinic_longitude', 8, 6)->nullable();
            $table->smallInteger('rating_count')->unsigned()->default(0);
            $table->smallInteger('like_count')->unsigned()->default(0);
            $table->boolean('status')->default(0);
            $table->text('facebook_link')->nullable();
            $table->text('twitter_link')->nullable();
            $table->text('googleplus_link')->nullable();
            $table->text('linkedin_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
