<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->mediumInteger('question_id')->unsigned();
            $table->mediumInteger('question_owner_id')->unsigned();
            $table->mediumInteger('doctor_id')->unsigned();
            $table->longText('answer');
            $table->smallInteger('likes')->unsigned()->default(0);
            $table->smallInteger('dislikes')->unsigned()->default(0);
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
        Schema::dropIfExists('answers');
    }
}
