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
//        $this->call(RouteSeeder::class);
//        $this->call(MenuSeeder::class);
//        $this->call(CountyTableSeeder::class);
//        $this->call(InventoryCategorySeeder::class);
//        $this->call(ServiceCategorySeeder::class);
//        $this->call(ServiceSeeder::class);
        #### Test Data
        $this->call(CategorySeeder::class);
=======

        $this->call(RolesSeeder::class);
        $this->call(MasterfileSeeder::class);
        $this->call(ContactTypeSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RouteSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(CountyTableSeeder::class);
        $this->call(InventoryCategorySeeder::class);
        $this->call(SystemConfigSeeder::class);


>>>>>>> 9d31fb5654a6cb129a35392d2b4fc6c28d89031a
    }
}
