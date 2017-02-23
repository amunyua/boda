<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('first_application_id')->unsigned()->index();
            $table->foreign('first_application_id')
                ->references('id')
                ->on('first_applications')
                ->onUpdate('cascade');
            $table->string('school_cert')->nullable();
            $table->string('religious_reference')->nullable();
            $table->string('government_character_reference')->nullable();
            $table->string('identification_card')->nullable();
            $table->string('good_conduct')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('second_applications');
    }
}
