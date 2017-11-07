<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vin',250);
            $table->double('price');
            $table->integer('model')->unsigned()->index();
            $table->foreign('model')
                ->references('id')
                ->on('bike_models')
                ->onUpdate('cascade');
//            $table->integer('make')->unsigned()->index()->nullable();
            $table->string('chassis_number');
            $table->boolean('status')->default('1');
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
        Schema::dropIfExists('bikes');
    }
}
