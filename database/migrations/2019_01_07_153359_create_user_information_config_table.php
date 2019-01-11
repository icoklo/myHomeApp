<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInformationConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_information_config', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('information_id')->unsigned();
            $table->string('name');
            $table->string('value')->nullable();

            $table->timestamps();
            $table->primary(['user_id', 'information_id', 'name']);
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
        Schema::dropIfExists('user_information_config');
    }
}
