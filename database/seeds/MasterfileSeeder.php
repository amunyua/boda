<?php

use Illuminate\Database\Seeder;
use App\Masterfile;
use App\Role;

class MasterfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masterfiles')->delete();
        $user_role = Role::where('role_code', 'SYS_ADMIN')->first();

        $admin = new Masterfile();
        $admin->surname = 'Admin';
        $admin->firstname = 'Admin';
        $admin->middlename = 'Admin';
        $admin->id_no = '12345678';
        $admin->registration_date = date('Y-m-d H:i:s');
        $admin->b_role = 'System Administrator';
        $admin->user_role = $user_role->id;
        $admin->phone_no = 254718503948;
        $admin->gender = 1;
        $admin->save();
    }
}
