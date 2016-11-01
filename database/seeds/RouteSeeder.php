<?php

use Illuminate\Database\Seeder;
use App\Route;
use App\Role;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('role_code', 'SYS_ADMIN')->first();
        #### Dashboard
        $dashboard = new Route();
        $dashboard->route_name = 'Dashboard';
        $dashboard->save();
        $dashboard_id = $dashboard->id;

        #### Dashboard child
        $analytics_dash = new Route();
        $analytics_dash->route_name = 'Analytics Dashboard';
        $analytics_dash->url = 'dashboard';
        $analytics_dash->parent_route = $dashboard_id;
        $analytics_dash->save();
        $analytics_dash->roles()->attach($admin);

        ### system
        $system = new Route();
        $system->route_name = 'System';
        $system->save();
        $system_id = $system->id;

        ### system children
        $route = new Route();
        $route->route_name = 'Routs';
        $route->url = 'routes';
        $route->parent_route = $system_id;
        $route->save();
        $route->roles()->attach($admin);

    }
}
