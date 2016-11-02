<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRouteStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:database/migrations/2016_10_14_052659_drop_categories_table.php
//        Schema::table('categories', function (Blueprint $table) {
//            $table->$this->down();
//        });
=======
        Schema::table('routes', function (Blueprint $table) {
            $table->boolean('route_status')->default(1)->change();
        });
>>>>>>> 2729e00a53a03e5474784fcc61cc99cff0b046ed:database/migrations/2016_11_01_094610_add_route_status.php
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes', function (Blueprint $table) {
            //
        });
    }
}
