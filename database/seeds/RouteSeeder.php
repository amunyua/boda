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
        DB::table('routes')->delete();

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

        #### registration
        $reg = new Route();
        $reg->route_name = 'Registration';
        $reg->save();
        $reg_id = $reg->id;

        #### registration children
        $registration = new Route();
        $registration->route_name = 'User Registration';
        $registration->url = 'registration';
        $registration->parent_route = $reg_id;
        $registration->save();
        $registration->roles()->attach($admin);

        // adding a user
        $add_reg = new Route();
        $add_reg->route_name = 'Add Registration';
        $add_reg->url = 'add-registration';
        $add_reg->parent_route = $reg_id;
        $add_reg->save();
        $add_reg->roles()->attach($admin);

        #### Application
        $app = new Route();
        $app->route_name = 'Application';
        $app->save();
        $app_id = $app->id;

        #### Application children
        $all_app = new Route();
        $all_app->route_name = 'All Application';
        $all_app->url = 'all_applications';
        $all_app->parent_route = $app_id;
        $all_app->save();
        $all_app->roles()->attach($admin);

        $pend_app = new Route();
        $pend_app->route_name = 'Pending Application';
        $pend_app->url = 'pending_applications';
        $pend_app->parent_route = $app_id;
        $pend_app->save();
        $pend_app->roles()->attach($admin);

        $canc_app = new Route();
        $canc_app->route_name = 'Cancelled Application';
        $canc_app->url = 'canceled_applications';
        $canc_app->parent_route = $app_id;
        $canc_app->save();
        $canc_app->roles()->attach($admin);

        $appr_app = new Route();
        $appr_app->route_name = 'Approved Application';
        $appr_app->url = 'approved_applications';
        $appr_app->parent_route = $app_id;
        $appr_app->save();
        $appr_app->roles()->attach($admin);

        #### inventory
        $inventory = new Route();
        $inventory->route_name = 'Inventory';
        $inventory->save();
        $inventory_id = $inventory->id;

        #### inventory children
        $item = new Route();
        $item->route_name = 'Manage Inventory';
        $item->url = 'manage_inventory';
        $item->parent_route = $inventory_id;
        $item->save();
        $item->roles()->attach($admin);

        $category = new Route();
        $category->route_name = 'Categories';
        $category->url = 'categories';
        $category->parent_route = $inventory_id;
        $category->save();
        $category->roles()->attach($admin);

        #### client
        $client = new Route();
        $client->route_name = 'Client';
        $client->save();
        $client_id = $client->id;

        #### client children
        $acc = new Route();
        $acc->route_name = 'Client Account';
        $acc->url = 'client_account';
        $acc->parent_route = $client_id;
        $acc->save();
        $acc->roles()->attach($admin);

        $wallet = new Route();
        $wallet->route_name = 'Client Wallet';
        $wallet->url = 'client_wallet';
        $wallet->parent_route = $client_id;
        $wallet->save();
        $wallet->roles()->attach($admin);

        #### service
        $service = new Route();
        $service->route_name = 'Service';
        $service->save();
        $service_id = $service->id;

        #### service children
        $service_category = new Route();
        $service_category->route_name = 'Service Category';
        $service_category->url = 'service_category';
        $service_category->parent_route = $service_id;
        $service_category->save();
        $service_category->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'Add Service Category';
        $route->url = 'add-sc-cats';
        $route->parent_route = $service_id;
        $route->save();
        $route->roles()->attach($admin);

        $manage_service = new Route();
        $manage_service->route_name = 'Manage Services';
        $manage_service->url = 'manage_services';
        $manage_service->parent_route = $service_id;
        $manage_service->save();
        $manage_service->roles()->attach($admin);

        #### bills and payments
        $bp = new Route();
        $bp->route_name = 'Bills and Payment';
        $bp->save();
        $bp_id = $bp->id;

        #### service children
        $all_bills = new Route();
        $all_bills->route_name = 'All Bills';
        $all_bills->url = 'all_bills';
        $all_bills->parent_route = $bp_id;
        $all_bills->save();
        $all_bills->roles()->attach($admin);

        $pending_bills = new Route();
        $pending_bills->route_name = 'Pending Bills';
        $pending_bills->url = 'pending_bills';
        $pending_bills->parent_route = $bp_id;
        $pending_bills->save();
        $pending_bills->roles()->attach($admin);

        $all_payments = new Route();
        $all_payments->route_name = 'All Payments';
        $all_payments->url = 'all_payments';
        $all_payments->parent_route = $bp_id;
        $all_payments->save();
        $all_payments->roles()->attach($admin);

        #### reports
        $reports = new Route();
        $reports->route_name = 'Reports';
        $reports->save();
        $reports_id = $reports->id;

        #### service children
        $daily = new Route();
        $daily->route_name = 'Daily Summary Report';
        $daily->url = 'daily_summary_report';
        $daily->parent_route = $reports_id;
        $daily->save();
        $daily->roles()->attach($admin);

        $weekly = new Route();
        $weekly->route_name = 'Weekly Summary Reports';
        $weekly->url = 'weekly_summary_report';
        $weekly->parent_route = $reports_id;
        $weekly->save();
        $weekly->roles()->attach($admin);

        $monthly = new Route();
        $monthly->route_name = 'Monthly Summary Reports';
        $monthly->url = 'monthly_summary_report';
        $monthly->parent_route = $reports_id;
        $monthly->save();
        $monthly->roles()->attach($admin);

        #### system
        $system = new Route();
        $system->route_name = 'System';
        $system->save();
        $system_id = $system->id;

        #### system children
        $routes = new Route();
        $routes->route_name = 'System Routes';
        $routes->url = 'routes';
        $routes->parent_route = $system_id;
        $routes->save();
        $routes->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'System Menu';
        $menu->url = 'menu';
        $menu->parent_route = $system_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $system_config = new Route();
        $system_config->route_name = 'System Config';
        $system_config->url = 'system_config';
        $system_config->parent_route = $system_id;
        $system_config->save();
        $system_config->roles()->attach($admin);

        $theme_config = new Route();
        $theme_config->route_name = 'Theme Configuration';
        $theme_config->url = 'theme_config';
        $theme_config->parent_route = $system_id;
        $theme_config->save();
        $theme_config->roles()->attach($admin);

        $get_theme = new Route();
        $get_theme->route_name = 'Get Theme';
        $get_theme->url = 'get-theme';
        $get_theme->parent_route = $system_id;
        $get_theme->save();
        $get_theme->roles()->attach($admin);

        $backup = new Route();
        $backup->route_name = 'Backup';
        $backup->url = 'backup';
        $backup->parent_route = $system_id;
        $backup->save();
        $backup->roles()->attach($admin);

        #### user management
        $user_mngt = new Route();
        $user_mngt->route_name = 'User Management';
        $user_mngt->save();
        $user_mngt_id = $user_mngt->id;

        #### user management children
        $all_user = new Route();
        $all_user->route_name = 'All Users';
        $all_user->url = 'routes';
        $all_user->parent_route = $user_mngt_id;
        $all_user->save();
        $all_user->roles()->attach($admin);

        $roles = new Route();
        $roles->route_name = 'User Roles';
        $roles->url = 'user_roles';
        $roles->parent_route = $user_mngt_id;
        $roles->save();
        $roles->roles()->attach($admin);

        $audit_trail = new Route();
        $audit_trail->route_name = 'Audit Trail';
        $audit_trail->url = 'audit_trails';
        $audit_trail->parent_route = $user_mngt_id;
        $audit_trail->save();
        $audit_trail->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'Load Routes Allocation';
        $route->url = 'load-routes-allocation';
        $route->parent_route = $system_id;
        $route->save();
        $route->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'is Route Allocated';
        $route->url = 'check-allocated-route/{id}';
        $route->parent_route = $system_id;
        $route->save();
        $route->roles()->attach($admin);

        $route = new Route();
        $route->route_name= 'Attach Route';
        $route->url = 'attach-route';
        $route->parent_route = $system_id;
        $route->save();
        $route->roles()->attach($admin);

        $route = new Route();
        $route->route_name= 'Detach Route';
        $route->url = 'detach-route';
        $route->parent_route = $system_id;
        $route->save();
        $route->roles()->attach($admin);
    }
}
