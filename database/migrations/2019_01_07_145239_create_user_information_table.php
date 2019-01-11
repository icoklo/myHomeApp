<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInformationTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('user_information', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('information_id')->unsigned();
            $table->integer('sort_order')->nullable();
            $table->integer('poll_interval_2')->nullable();

            $table->timestamps();
            $table->primary(['user_id', 'information_id']);
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('information_id')
                ->references('id')
                ->on('information');

        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('user_information');
    }
}
