<?php

use Illuminate\Database\Seeder;
use App\Masterfile;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_mf = Masterfile::where('surname', 'Admin')->first();
        $sys_admin = \App\Role::where('role_code', 'SYS_ADMIN')->first();

        $admin = new \App\User();
        $admin->name = 'Admin Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt(123456);
        $admin->phone_no = '700000000';
        $admin->masterfile_id = $admin_mf->id;
        $admin->save();
        $admin->roles()->attach($sys_admin);
    }
}
