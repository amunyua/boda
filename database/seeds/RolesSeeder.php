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
        $student->role_name = 'Student';
        $student->role_code = 'STUDENT';
        $student->role_status = 1;
        $student->save();

        $teacher = new Role();
        $teacher->role_name = 'Teacher';
        $teacher->role_code = 'TEACHER';
        $teacher->role_status = 1;
        $teacher->save();

        $guardian = new Role();
        $guardian->role_name = 'Guardian';
        $guardian->role_code = 'GUARDIAN';
        $guardian->role_status = 1;
        $guardian->save();

        $guardian = new Role();
        $guardian->role_name = 'Subordinate Staff';
        $guardian->role_code = 'SS';
        $guardian->role_status = 1;
        $guardian->save();
    }
}
