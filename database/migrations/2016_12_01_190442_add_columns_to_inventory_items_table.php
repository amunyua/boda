<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_items', function (Blueprint $table) {
            $table->string('inventory_type',255);
            $table->integer('parent_category_id')->unsigned()->index()->nullable();
            $table->foreign('parent_category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')->onDelete('no action');
            $table->integer('subcategory_id')->nullable()->index()->unsigned;
            $table->string('vin',255)->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('code')->nullable();
            $table->double('cost_price')->nullable();
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_items', function (Blueprint $table) {
            //
        });
    }
}
