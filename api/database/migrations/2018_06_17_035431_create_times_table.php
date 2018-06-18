<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome' , 120);
            $table->integer('grupos_id')->unsigned();
            $table->foreign('grupos_id')->references('id')
                                         ->on('grupos')
                                         ->onDelete('cascade');
            $table->integer('continentes_id')->unsigned();
            $table->foreign('continentes_id')->references('id')
                                             ->on('continentes')
                                             ->onDelete('cascade');
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
        Schema::dropIfExists('times');
    }
}
