<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_account_id')->unsigned();
            $table->foreign('client_account_id')
                ->references('id')
                ->on('client_accounts')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->text('particulars');
            $table->integer('masterfile_id')->unsigned();
            $table->foreign('masterfile_id')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->double('amount');
            $table->string('dr_cr');
            $table->integer('customer_bill_id')->unsigned()->nullable();
            $table->foreign('customer_bill_id')
                ->references('id')
                ->on('customer_bills')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('transaction_id')->unsigned()->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('journals');
    }
}
