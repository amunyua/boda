<?php

use Illuminate\Database\Seeder;
use App\ContactTypes;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main = new ContactTypes();
        $main->contact_type_name = 'Main';
        $main->contact_type_code = 'MAIN';
        $main->contact_type_status = 1;
        $main->save();
    }
}
