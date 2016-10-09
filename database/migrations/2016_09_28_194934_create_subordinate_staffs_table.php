<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubordinateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subordinate_staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('masterfile_id')->unsigned();
            $table->string('nhif_no', 255)->nullable();
            $table->string('nssf_no', 255)->nullable();
            $table->string('kra_pin', 255)->nullable();
            $table->foreign('masterfile_id')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('subordinate_staffs');
    }
}
