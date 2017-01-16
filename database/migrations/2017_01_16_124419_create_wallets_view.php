<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallets_view', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement(
                "create or replace view wallets_view as
                    select
                      cw.*,
                      concat(m.surname,' ',m.firstname,' ',m.middlename) as rider,
                      if(cw.status = 1, 'Active', 'Inactive') as wallet_status,
                      ca.bike_id,
                      ca.masterfile_id
                    from client_wallets cw
                    left join client_accounts ca on cw.client_account_id = ca.id
                    left join masterfiles m on ca.masterfile_id = m.id
            "
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallets_view', function (Blueprint $table) {
            //
        });
    }
}
