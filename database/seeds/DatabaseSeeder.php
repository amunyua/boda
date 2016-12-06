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
//        $this->call(RolesSeeder::class);
//        $this->call(MasterfileSeeder::class);
//        $this->call(ContactTypeSeeder::class);
//        $this->call(AddressSeeder::class);
//        $this->call(UserSeeder::class);
        $this->call(RouteSeeder::class);
        $this->call(MenuSeeder::class);
//        $this->call(CountyTableSeeder::class);
=======
//         $this->call(MasterfileSeeder::class);
//         $this->call(RolesSeeder::class);
//         $this->call(UserSeeder::class);
//         $this->call(RolesSeeder::class);
//         $this->call(UserSeeder::class);
         $this->call(RouteSeeder::class);
         $this->call(MenuSeeder::class);
//         $this->call(CountyTableSeeder::class);
//         $this->call(ContactTypeSeeder::class);
//        $this->call(InventoryCategorySeeder::class);
>>>>>>> 3024c3e48efc613ed0900b77bc253b2db77add02
    }
}
