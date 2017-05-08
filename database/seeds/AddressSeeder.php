<?php

use Illuminate\Database\Seeder;
use App\Masterfile;
use App\ContactTypes;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->delete();

        $admin_mf = Masterfile::where('surname', 'Admin')->first();
        $contact_type = ContactTypes::where('contact_type_code', 'MAIN')->first();

        $address = new \App\Address();
        $address->county = 'Nairobi';
        $address->city = 'Nairobi';
        $address->masterfile_id = $admin_mf->id;
        $address->contact_type_id = $contact_type->id;
        $address->email = 'admin@admin.com';
        $address->phone_no = 0700000000;
        $address->tel_no = 0700000000;
        $address->postal_address = 0000;
        $address->postal_code = 00100;
        $address->physical_address = 'Nairobi';
        $address->save();
    }
}
