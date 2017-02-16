<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillDataView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_data', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement('
                create or replace view bill_data as
                select
                cb.*,
                concat(m.surname,\' \',m.firstname,\' \',m.middlename) as rider,
                sc.service_name
                from customer_bills cb
                left join masterfiles m on cb.masterfile_id = m.id
                left join services sc on cb.service_id = sc.id
            ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_data', function (Blueprint $table) {
            //
        });
    }
}
