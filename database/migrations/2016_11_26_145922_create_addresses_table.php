<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('county');
            $table->string('city');
            $table->integer('masterfile_id')->unsigned();
            $table->foreign('masterfile_id')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('contact_type_id')->unsigned();
            $table->foreign('contact_type_id')
                ->references('id')
                ->on('contact_types')
                ->onUpdate('cascade');
            $table->string('email')->nulluble();
            $table->string('phone_no');
            $table->string('tel_no')->nulluble();
            $table->string('postal_address');
            $table->integer('postal_code');
            $table->string('physical_address');
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
        Schema::dropIfExists('addresses');
    }
}
