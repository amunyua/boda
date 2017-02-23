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
//        DB::table('menus')->delete();

        \Illuminate\Support\Facades\DB::table('menus')->delete();
        #### Dashboard
        $dashboard_route = Route::where('route_name', 'Dashboard')->first();
        $dashboard = new Menu();
        $dashboard->fa_icon = 'fa-home';
        $dashboard->route_id = $dashboard_route->id;
        $dashboard->sequence = 1;
        $dashboard->save();
        $dashboard_id = $dashboard->id;

        $analytics_route = Route::where('route_name', 'Analytics Dashboard')->first();
        $analytics = new Menu();
        $analytics->route_id = $analytics_route->id;
        $analytics->parent_menu = $dashboard->id;
        $analytics->sequence = 1;
        $analytics->save();

        #### registration
        $registration_route = Route::where('route_name', 'Registration')->first();
        $registration = new Menu();
        $registration->fa_icon = 'fa-group';
        $registration->route_id = $registration_route->id;
        $registration->sequence = 2;
        $registration->save();
        $registration_id = $registration->id;

        $user_reg_route = Route::where('route_name', 'User Registration')->first();
        $user_reg = new Menu();
        $user_reg->route_id = $user_reg_route->id;
        $user_reg->parent_menu = $registration->id;
        $user_reg->sequence = 1;
        $user_reg->save();

        //all Registration
        $all_registration_route = Route::where('route_name', 'All Registration')->first();
        $all_mfs = new Menu();
        $all_mfs->route_id = $all_registration_route->id;
        $all_mfs->parent_menu = $registration->id;
        $all_mfs->sequence = 2;
        $all_mfs->save();

        //all inactive users
        $all_inactive_users = Route::where('route_name', 'Inactive Users')->first();
        $inactive_users = new Menu();
        $inactive_users->route_id = $all_inactive_users->id;
        $inactive_users->parent_menu = $registration->id;
        $inactive_users->sequence = 3;
        $inactive_users->save();

        #### application
        $application_route = Route::where('route_name', 'First Applications')->first();
        $application = new Menu();
        $application->fa_icon = 'fa-folder';
        $application->route_id = $application_route->id;
        $application->sequence = 3;
        $application->save();
        $application_id = $application->id;

        $all_application_route = Route::where('route_name', 'All First Applications')->first();
        $all_application = new Menu();
        $all_application->route_id = $all_application_route->id;
        $all_application->parent_menu = $application->id;
        $all_application->sequence = 1;
        $all_application->save();

        $pending_application_route = Route::where('route_name', 'Pending Application')->first();
        $pending_application = new Menu();
        $pending_application->route_id = $pending_application_route->id;
        $pending_application->parent_menu = $application->id;
        $pending_application->sequence = 2;
        $pending_application->save();

        $canceled_application_route = Route::where('route_name', 'Cancelled Application')->first();
        $canceled_application = new Menu();
        $canceled_application->route_id = $canceled_application_route->id;
        $canceled_application->sequence = 3;
        $canceled_application->parent_menu = $application->id;
        $canceled_application->save();

        $approved_application_route = Route::where('route_name', 'Approved Application')->first();
        $approved_application = new Menu();
        $approved_application->route_id = $approved_application_route->id;
        $approved_application->parent_menu = $application->id;
        $approved_application->sequence = 4;
        $approved_application->save();

        #### Second application
        $application_route = Route::where('route_name', 'Second Applications')->first();
        $application = new Menu();
        $application->fa_icon = 'fa-folder';
        $application->route_id = $application_route->id;
        $application->sequence = 4;
        $application->save();
        $s_application_id = $application->id;

        //second application children
        $second_application_route = Route::where('route_name', 'All Second Applications')->first();
        $second_application = new Menu();
        $second_application->route_id = $second_application_route->id;
        $second_application->parent_menu = $s_application_id;
        $second_application->sequence = 4;
        $second_application->save();

        #### inventory
        $inventory_route = Route::where('route_name', 'Inventory')->first();
        $inventory = new Menu();
        $inventory->fa_icon = 'fa-book';
        $inventory->route_id = $inventory_route->id;
        $inventory->sequence = 4;
        $inventory->save();
        $inventory_id = $inventory->id;

        $item_route = Route::where('route_name', 'Manage Inventory')->first();
        $item = new Menu();
        $item->route_id = $item_route->id;
        $item->parent_menu = $inventory->id;
        $item->sequence = 1;
        $item->save();

        $category_route = Route::where('route_name', 'Manage Categories')->first();
        $category = new Menu();
        $category->route_id = $category_route->id;
        $category->parent_menu = $inventory->id;
        $category->sequence = 2;
        $category->save();

        $category_route = Route::where('route_name', 'Stock Transactions')->first();
        $category = new Menu();
        $category->route_id = $category_route->id;
        $category->parent_menu = $inventory->id;
        $category->sequence = 3;
        $category->save();

        $category_route = Route::where('route_name', 'Manage Motorbikes')->first();
        $category = new Menu();
        $category->route_id = $category_route->id;
        $category->parent_menu = $inventory->id;
        $category->sequence = 4;
        $category->save();

        $model_route = Route::where('route_name', 'Manage Motorbikes Models')->first();
        $model = new Menu();
        $model->route_id = $model_route->id;
        $model->parent_menu = $inventory->id;
        $model->sequence = 5;
        $model->save();

        $item_route = Route::where('route_name', 'Inventory Allocation')->first();
        $item = new Menu();
        $item->route_id = $item_route->id;
        $item->parent_menu = $inventory->id;
        $item->sequence = 6;
        $item->save();

        #### clients
        $clients_route = Route::where('route_name', 'Client')->first();
        $clients = new Menu();
        $clients->fa_icon = 'fa-user';
        $clients->route_id = $clients_route->id;
        $clients->sequence = 5;
        $clients->save();
        $clients_id = $clients->id;

        $client_acc_route = Route::where('route_name', 'Client Accounts')->first();
        $client_acc = new Menu();
        $client_acc->route_id = $client_acc_route->id;
        $client_acc->parent_menu = $clients->id;
        $client_acc->sequence = 1;
        $client_acc->save();

        $wallet_route = Route::where('route_name', 'Client Wallet')->first();
        $wallet = new Menu();
        $wallet->route_id = $wallet_route->id;
        $wallet->parent_menu = $clients->id;
        $wallet->sequence = 2;
        $wallet->save();

        #### service
        $service_route = Route::where('route_name', 'Service')->first();
        $service = new Menu();
        $service->fa_icon = 'fa-exchange';
        $service->route_id = $service_route->id;
        $service->sequence = 6;
        $service->save();
        $service_id = $service->id;

        $service_category_route = Route::where('route_name', 'Service Category')->first();
        $service_category = new Menu();
        $service_category->route_id = $service_category_route->id;
        $service_category->parent_menu = $service->id;
        $service_category->sequence = 1;
        $service_category->save();

        $manage_service_route = Route::where('route_name', 'Manage Services')->first();
        $manage_service = new Menu();
        $manage_service->route_id = $manage_service_route->id;
        $manage_service->parent_menu = $service->id;
        $manage_service->sequence = 2;
        $manage_service->save();


        #### Bills and Payments
        $cb_route = Route::where('route_name', 'Bills And Payments')->first();
        $bps = new Menu();
        $bps->fa_icon = 'fa-money';
        $bps->route_id = $cb_route->id;
        $bps->sequence = 7;
        $bps->save();

        $cb_route = Route::where('route_name', 'Customer Bills')->first();
        $menu = new Menu();
        $menu->route_id = $cb_route->id;
        $menu->parent_menu = $bps->id;
        $menu->sequence = 1;
        $menu->save();

        #### user management
        $user_mngt_route = Route::where('route_name', 'User Management')->first();
        $user_mngt = new Menu();
        $user_mngt->fa_icon = 'fa-group';
        $user_mngt->route_id = $user_mngt_route->id;
        $user_mngt->sequence = 8;
        $user_mngt->save();
        $user_mngt_id = $user_mngt->id;

        $all_user_route = Route::where('route_name', 'All Users')->first();
        $all_user = new Menu();
        $all_user->route_id = $all_user_route->id;
        $all_user->parent_menu = $user_mngt->id;
        $all_user->sequence = 1;
        $all_user->save();

        $role_route = Route::where('route_name', 'User Roles')->first();
        $role = new Menu();
        $role->route_id = $role_route->id;
        $role->parent_menu = $user_mngt->id;
        $role->sequence = 2;
        $role->save();
        $all_user->save();

        $audit_trail_route = Route::where('route_name', 'Audit Trail')->first();
        $audit_trail = new Menu();
        $audit_trail->route_id = $audit_trail_route->id;
        $audit_trail->parent_menu = $user_mngt->id;
        $audit_trail->sequence = 3;
        $audit_trail->save();

        #### system
        $system_route = Route::where('route_name', 'System')->first();
        $system = new Menu();
        $system->fa_icon = 'fa-cogs';
        $system->route_id = $system_route->id;
        $system->sequence = 9;
        $system->save();
        $system_id = $system->id;

        $routes_route = Route::where('route_name', 'System Routes')->first();
        $routes = new Menu();
        $routes->route_id = $routes_route->id;
        $routes->parent_menu = $system->id;
        $routes->sequence = 1;
        $routes->save();

        $menu_route = Route::where('route_name', 'System Menu')->first();
        $menu = new Menu();
        $menu->route_id = $menu_route->id;
        $menu->parent_menu = $system->id;
        $menu->sequence = 2;
        $menu->save();

        $config_route = Route::where('route_name', 'Load System Configuration')->first();
        $sys_config = new Menu();
        $sys_config->route_id = $config_route->id;
        $sys_config->parent_menu = $system->id;
        $sys_config->sequence = 3;
        $sys_config->save();

        $theme_route = Route::where('route_name', 'Theme Configuration')->first();
        $theme_config = new Menu();
        $theme_config->route_id = $theme_route->id;
        $theme_config->parent_menu = $system->id;
        $theme_config->sequence = 4;
        $theme_config->save();

        $backup_route = Route::where('route_name', 'Backup')->first();
        $backup = new Menu();
        $backup->route_id = $backup_route->id;
        $backup->parent_menu = $system->id;
        $backup->sequence = 5;
        $backup->save();

    }
}
