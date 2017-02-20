<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterfiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname', 50);
            $table->string('firstname', 50);
            $table->string('middlename', 50)->nullable();
            $table->text('image_path')->nullable();
            $table->string('id_no')->nullable();
            $table->date('registration_date');
            $table->string('b_role', 50);
            $table->string('user_role', 50);
            $table->boolean('gender');
            $table->boolean('status')->default(1);
            $table->bigInteger('phone_no')->unique();
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
        Schema::dropIfExists('masterfile');
    }
}
