<?php

use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sc = new \App\ServiceCategory();
        $sc->service_category_name = 'Boda Boda';
        $sc->service_category_code = 'BD';
        $sc->service_category_status = 1;
        $sc->save();
    }
}
