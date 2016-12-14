<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //all users view
        DB::statement(
            "CREATE OR REPLACE VIEW all_users AS
              SELECT ru.user_id,
                r.role_name,
                concat(m.surname,' ',m.firstname,' ',m.middlename) AS full_name,
                u.status,
                u.id
              FROM role_user ru
                LEFT JOIN masterfiles m ON m.id = ru.user_id
                LEFT JOIN roles r ON r.id = ru.role_id
            LEFT JOIN users u ON u.id = m.id"
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
