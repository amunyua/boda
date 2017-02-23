<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllMfs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //all mfs view
        DB::statement(
            "CREATE OR REPLACE VIEW all_masterfile AS
              SELECT m.id,
                concat(m.surname, ' ', m.firstname, ' ', m.middlename) AS full_name,
                m.id_no,
                m.gender,
                m.b_role,
                m.user_role,
                r.role_name,
                m.status,
                m.registration_date,
                ad.email,
                ad.phone_no,
                ad.postal_address,
                ad.postal_code,
                ad.physical_address,
                ad.county,
                ad.city
              FROM masterfiles m
            LEFT JOIN addresses a ON m.id = a.masterfile_id
            LEFT JOIN roles r ON r.id = m.user_role
            LEFT JOIN addresses ad ON ad.masterfile_id = m.id"
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
