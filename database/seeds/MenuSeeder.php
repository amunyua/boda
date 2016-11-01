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

        #### registration
        $registration_route = Route::where('route_name', 'Registration')->first();
        $registration = new Menu();
        $registration->route_id = $registration_route->id;
        $registration->save();
        $registration_id = $registration->id;

        $staff_route = Route::where('route_name', 'Staff')->first();
        $staff = new Menu();
        $staff->route_id = $staff_route->id;
        $staff->parent_menu = $registration->id;
        $staff->save();

        $client_route = Route::where('route_name', 'Client')->first();
        $client = new Menu();
        $client->route_id = $client_route->id;
        $client->parent_menu = $registration->id;
        $client->save();

        #### application
        $application_route = Route::where('route_name', 'Application')->first();
        $application = new Menu();
        $application->route_id = $application_route->id;
        $application->save();
        $application_id = $application->id;

        $all_application_route = Route::where('route_name', 'All Application')->first();
        $all_application = new Menu();
        $all_application->route_id = $all_application_route->id;
        $all_application->parent_menu = $application->id;
        $all_application->save();

        $pending_application_route = Route::where('route_name', 'Pending Application')->first();
        $pending_application = new Menu();
        $pending_application->route_id = $pending_application_route->id;
        $pending_application->parent_menu = $application->id;
        $pending_application->save();

        $canceled_application_route = Route::where('route_name', 'Canceled Application')->first();
        $canceled_application = new Menu();
        $canceled_application->route_id = $canceled_application_route->id;
        $canceled_application->parent_menu = $application->id;
        $canceled_application->save();

        $approved_application_route = Route::where('route_name', 'Approved Application')->first();
        $approved_application = new Menu();
        $approved_application->route_id = $approved_application_route->id;
        $approved_application->parent_menu = $application->id;
        $approved_application->save();

        #### inventory
        $inventory_route = Route::where('route_name', 'Inventory')->first();
        $inventory = new Menu();
        $inventory->route_id = $inventory_route->id;
        $inventory->save();
        $inventory_id = $inventory->id;

        $item_route = Route::where('route_name', 'Manage Inventory')->first();
        $item = new Menu();
        $item->route_id = $item_route->id;
        $item->parent_menu = $inventory->id;
        $item->save();

        $category_route = Route::where('route_name', 'categories')->first();
        $category = new Menu();
        $category->route_id = $category_route->id;
        $category->parent_menu = $inventory->id;
        $category->save();

        #### clients
        $clients_route = Route::where('route_name', 'Clients')->first();
        $clients = new Menu();
        $clients->route_id = $clients_route->id;
        $clients->save();
        $clients_id = $clients->id;

        $client_acc_route = Route::where('route_name', 'Client Account')->first();
        $client_acc = new Menu();
        $client_acc->route_id = $client_acc_route->id;
        $client_acc->parent_menu = $clients->id;
        $client_acc->save();

        $wallet_route = Route::where('route_name', 'Client Wallet')->first();
        $wallet = new Menu();
        $wallet->route_id = $wallet_route->id;
        $wallet->parent_menu = $clients->id;
        $wallet->save();

        #### service
        $service_route = Route::where('route_name', 'Service')->first();
        $service = new Menu();
        $service->route_id = $service_route->id;
        $service->save();
        $service_id = $service->id;

        $service_category_route = Route::where('route_name', 'Service Category')->first();
        $service_category = new Menu();
        $service_category->route_id = $service_category_route->id;
        $service_category->parent_menu = $service->id;
        $service_category->save();

        $manage_service_route = Route::where('route_name', 'Manage Service')->first();
        $manage_service = new Menu();
        $manage_service->route_id = $manage_service_route->id;
        $manage_service->parent_menu = $service->id;
        $manage_service->save();

        #### system
        $system_route = Route::where('route_name', 'System')->first();
        $system = new Menu();
        $system->route_id = $system_route->id;
        $system->save();
        $system_id = $system->id;

        $routes_route = Route::where('route_name', 'System Routes')->first();
        $routes = new Menu();
        $routes->route_id = $routes_route->id;
        $routes->parent_menu = $system->id;
        $routes->save();

        $menu_route = Route::where('route_name', 'System Menu')->first();
        $menu = new Menu();
        $menu->route_id = $menu_route->id;
        $menu->parent_menu = $system->id;
        $menu->save();

        $sys_config_route = Route::where('route_name', 'System Configuration')->first();
        $sys_config = new Menu();
        $sys_config->route_id = $sys_config_route->id;
        $sys_config->parent_menu = $system->id;
        $sys_config->save();

        $backup_route = Route::where('route_name', 'Backup')->first();
        $backup = new Menu();
        $backup->route_id = $backup_route->id;
        $backup->parent_menu = $system->id;
        $backup->save();

        #### user management
        $user_mngt_route = Route::where('route_name', 'User Management')->first();
        $user_mngt = new Menu();
        $user_mngt->route_id = $user_mngt_route->id;
        $user_mngt->save();
        $user_mngt_id = $user_mngt->id;

        $all_user_route = Route::where('route_name', 'All User')->first();
        $all_user = new Menu();
        $all_user->route_id = $all_user_route->id;
        $all_user->parent_menu = $user_mngt->id;
        $all_user->save();

        $role_route = Route::where('route_name', 'User Roles')->first();
        $role = new Menu();
        $role->route_id = $role_route->id;
        $role->parent_menu = $user_mngt->id;
        $role->save();
        $all_user->save();

        $audit_trail_route = Route::where('route_name', 'Audit Trail')->first();
        $audit_trail = new Menu();
        $audit_trail->route_id = $audit_trail_route->id;
        $audit_trail->parent_menu = $user_mngt->id;
        $audit_trail->save();
    }
}
