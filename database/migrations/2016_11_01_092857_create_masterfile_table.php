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
            $table->string('middlename', 50);
            $table->text('image_path')->nullable();
            $table->string('id_no');
            $table->date('registration_date');
            $table->string('b_role', 50);
            $table->string('user_role', 50);
            $table->boolean('status')->default('TRUE');
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
