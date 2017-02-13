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
        DB::table('contact_types')->delete();

        $main = new ContactTypes();
        $main->contact_type_name = 'Main';
        $main->contact_type_code = 'MAIN';
        $main->contact_type_status = 1;
        $main->save();

        $office = new ContactTypes();
        $office->contact_type_name = 'Office';
        $office->contact_type_code = 'OFFICE';
        $office->contact_type_status = 1;
        $office->save();

        $work = new ContactTypes();
        $work->contact_type_name = 'Work';
        $work->contact_type_code = 'WORK';
        $work->contact_type_status = 1;
        $work->save();

        $home = new ContactTypes();
        $home->contact_type_name = 'Home';
        $home->contact_type_code = 'HOME';
        $home->contact_type_status = 1;
        $home->save();
    }
}
