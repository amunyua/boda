<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_account_id')->unsigned();
            $table->foreign('client_account_id')
                ->references('id')
                ->on('client_accounts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->double('bill_amount');
            $table->integer('masterfile_id')->unsigned();
            $table->foreign('masterfile_id')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->double('bill_balance')->default(0);
            $table->double('amount_paid')->default(0);
            $table->boolean('bill_status')->default(0);
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->date('bill_date');
            $table->date('bill_due_date');
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
        Schema::dropIfExists('customer_bills');
    }
}
