<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')
                ->references('id')
                ->on('inventory_items')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('transaction_category',255);
            $table->string('transaction_type',255);
            $table->integer('new_level')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('running_stock')->nullable();
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
        Schema::dropIfExists('stock_transactions');
    }
}
