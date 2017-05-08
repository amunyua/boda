<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Adddocumentsid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masterfiles', function (Blueprint $table) {
            $table->integer('documents_id')->unsigned()->index()->nullable();
            $table->foreign('documents_id')
                ->references('id')
                ->on('second_applications')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masterfiles', function (Blueprint $table) {
            //
        });
    }
}
