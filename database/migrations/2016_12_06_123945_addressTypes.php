<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddressTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //all address types
        DB::statement(
            "CREATE OR REPLACE VIEW all_address_type AS
                SELECT a.masterfile_id,
                 a.county,
                 a.city,
                 a.email,
                 a.tel_no,
                 a.phone_no,
                 a.postal_address,
                 a.physical_address,
                 a.postal_code,
                 c.contact_type_name,
                 c.contact_type_code
                FROM contact_types c
                LEFT JOIN addresses a ON c.id = a.contact_type_id"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
