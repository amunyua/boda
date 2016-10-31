<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\Route;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #### Dashboard
        $dashboard_route = Route::where('route_name', 'Dashboard')->first();
        $dashboard = new Menu();
        $dashboard->route_id = $dashboard_route->id;
        $dashboard->save();
        $dashboard_id = $dashboard->id;

        $analytics_route = Route::where('route_name', 'Analytics Dashboard')->first();
        $analytics = new Menu();
        $analytics->route_id = $analytics_route->id;
        $analytics->parent_menu = $dashboard->id;
        $analytics->save();
    }
}
