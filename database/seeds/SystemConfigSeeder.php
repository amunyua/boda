<?php

use Illuminate\Database\Seeder;
use \App\SystemConfig;

class SystemConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_configs')->delete();

        $sys = new SystemConfig();
        $sys->company_name = 'Boda Squared';
        $sys->company_logo = 'uploads/images/58399efce714ebike.JPG';
        $sys->email = 'bodasquared@admin.com';
        $sys->email_two = 'bodasquared@admin.com';
        $sys->tel_one = '0700111222';
        $sys->tel_two = '0733444555';
        $sys->tel_three = '0766777888';
        $sys->box_office = '090';
        $sys->physical_address = 'Nairobi';
        $sys->paybill_no = '00000';
        $sys->service_pin = '00000';
        $sys->save();
    }
}
