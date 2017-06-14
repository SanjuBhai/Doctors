<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->mediumIncrements('id');
            $table->tinyInteger('role_id')->unsigned()->default(3);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->bigInteger('phone')->unsigned()->nullable();
            $table->string('image')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->string('google_id')->nullable();
            $table->enum('device_type', ['1', '2', '3'])->default('1')->comment('1 for Web, 2 for Android, 3 for IOS');
            $table->boolean('is_email_verified')->default('0')->comment('0 for unverified, 1 for verified');
            $table->rememberToken();
            $table->integer('ip_address')->unsigned()->nullable();
            $table->text('user_agent')->nullable();
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
        Schema::dropIfExists('users');
    }
}
