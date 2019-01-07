<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_config', function (Blueprint $table) {
            $table->string('name');
            $table->integer('information_id')->unsigned();
            $table->string('default_value')->nullable();

            $table->timestamps();
            $table->primary(['name', 'information_id']);
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
        Schema::dropIfExists('information_config');
    }
}
