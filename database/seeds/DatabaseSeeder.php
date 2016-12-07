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
//         $this->call(MasterfileSeeder::class);
//         $this->call(RolesSeeder::class);
//         $this->call(UserSeeder::class);
//         $this->call(RolesSeeder::class);
         $this->call(UserSeeder::class);
//         $this->call(RouteSeeder::class);
//         $this->call(MenuSeeder::class);
//         $this->call(CountyTableSeeder::class);
//         $this->call(ContactTypeSeeder::class);
//        $this->call(InventoryCategorySeeder::class);
    }
}
