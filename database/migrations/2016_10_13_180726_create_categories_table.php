<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('categories', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('parent_category')->nullable();
//            $table->foreign('parent_category')
//                ->references('id')
//                ->on('categories')
//                ->onUpdate('cascade');
//            $table->string('category_name');
//            $table->string('code');
//            $table->boolean('status');
//
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
