<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
//         $this->call(MasterfileSeeder::class);
//         $this->call(RolesSeeder::class);
//         $this->call(UserSeeder::class);
=======
         $this->call(MasterfileSeeder::class);
<<<<<<< HEAD
         $this->call(UserSeeder::class);
         $this->call(RolesSeeder::class);
=======
         $this->call(RolesSeeder::class);
         $this->call(UserSeeder::class);
>>>>>>> 9f8d25edf2b7545892611629877eb8635fd23408
>>>>>>> 3a9e16f20eafa0c3628b1ab5ddad6ee4e77fda82
         $this->call(RouteSeeder::class);
         $this->call(MenuSeeder::class);
         $this->call(CountyTableSeeder::class);
         $this->call(ContactTypeSeeder::class);
    }
}
