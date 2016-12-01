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
                r.role_name,
                m.status,
                m.registration_date,
                a.email
              FROM masterfiles m
            LEFT JOIN addresses a ON m.id = a.masterfile_id
            LEFT JOIN roles r ON r.id = m.user_role"
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
