<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_journals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_account_id')->unsigned();
            $table->integer('client_wallet_id')->unsigned();
            $table->foreign('client_account_id')
                ->references('id')
                ->on('client_accounts')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->foreign('client_wallet_id')
                ->references('id')
                ->on('client_wallets')
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
        Schema::dropIfExists('wallet_journals');
    }
}
