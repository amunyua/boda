<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = new Role();
        $student->role_name = 'System Admin';
        $student->role_code = 'SYS_ADMIN';
        $student->role_status = 1;
        $student->save();
    }
}
