<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBikeInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bike_insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('insurance_name',50);
            $table->string('insurance_company_name',50);
            $table->dateTime('issue_date');
            $table->dateTime('expiry_date');
            $table->boolean('status');
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
        Schema::dropIfExists('bike_insurances');
    }
}
