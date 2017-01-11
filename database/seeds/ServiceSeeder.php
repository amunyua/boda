<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    const category_code = 'BD';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get the service category
        $sc = \App\ServiceCategory::where('service_category_code', self::category_code)->first();

        $service = new \App\Service();
        $service->service_category_id = $sc->id;
        $service->service_code = 'BBDS';
        $service->service_name = 'Boda Boda Services';
        $service->price = 0;
        $service->save();
        $parent_id = $service->id;

        $service = new \App\Service();
        $service->service_category_id = $sc->id;
        $service->parent_service = $parent_id;
        $service->price = 500;
        $service->service_code = 'BRCIC';
        $service->service_name = 'Boda Rides Daily Collection';
        $service->save();
    }
}
