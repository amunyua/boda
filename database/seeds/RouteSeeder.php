<?php

use Illuminate\Database\Seeder;
use App\Route;
use App\Role;
use Illuminate\Support\Facades\DB;

class RouteSeeder extends Seeder
{
    const SystemAdmin = 'SYS_ADMIN';
    const ClientAdmin = 'CLIENTADMIN';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routes')->delete();

        $admin = Role::userRole(self::SystemAdmin);
        $client_admin = Role::userRole(self::ClientAdmin);
        #### Dashboard
        $dashboard = new Route();
        $dashboard->route_name = 'Dashboard';
        $dashboard->save();
        $dashboard_id = $dashboard->id;

        $home = new Route();
        $home->route_name = 'Home';
        $home->url = 'home';
        $home->parent_route = $dashboard_id;
        $home->save();
        $home->roles()->attach($admin);
        $home->roles()->attach($client_admin);

        $home = new Route();
        $home->route_name = 'Home';
        $home->url = '/';
        $home->parent_route = $dashboard_id;
        $home->save();
        $home->roles()->attach($admin);
        $home->roles()->attach($client_admin);

        #### Dashboard child
        $analytics_dash = new Route();
        $analytics_dash->route_name = 'Analytics Dashboard';
        $analytics_dash->url = 'dashboard';
        $analytics_dash->parent_route = $dashboard_id;
        $analytics_dash->save();
        $analytics_dash->roles()->attach($admin);
        $analytics_dash->roles()->attach($client_admin);

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
        $registration->roles()->attach($client_admin);

        //all Registration
        $all_mfs = new Route();
        $all_mfs->route_name = 'All Registration';
        $all_mfs->url = 'all-mfs';
        $all_mfs->parent_route = $reg_id;
        $all_mfs->save();
        $all_mfs->roles()->attach($admin);
        $all_mfs->roles()->attach($client_admin);

        //all staff
        $all_staff = new Route();
        $all_staff->route_name = 'All Staff';
        $all_staff->url = 'all-staffs';
        $all_staff->parent_route = $reg_id;
        $all_staff->save();
        $all_staff->roles()->attach($admin);
        $all_staff->roles()->attach($client_admin);

        //all clients
        $all_clients = new Route();
        $all_clients->route_name = 'All Clients';
        $all_clients->url = 'all-clients';
        $all_clients->parent_route = $reg_id;
        $all_clients->save();
        $all_clients->roles()->attach($admin);
        $all_clients->roles()->attach($client_admin);

        // adding a user
        $add_reg = new Route();
        $add_reg->route_name = 'Add Registration';
        $add_reg->url = 'add-registration';
        $add_reg->parent_route = $reg_id;
        $add_reg->save();
        $add_reg->roles()->attach($admin);
        $add_reg->roles()->attach($client_admin);

        // edit user
        $edit_user = new Route();
        $edit_user->route_name = 'Edit User Registration';
        $edit_user->url = 'edit-mf/{id}';
        $edit_user->parent_route = $reg_id;
        $edit_user->save();
        $edit_user->roles()->attach($admin);
        $edit_user->roles()->attach($client_admin);

        ### soft delete user registration
        $soft_del = new Route();
        $soft_del->route_name = 'Soft Delete Masterfile';
        $soft_del->url = 'soft-delete-mf/{id}';
        $soft_del->parent_route = $reg_id;
        $soft_del->save();
        $soft_del->roles()->attach($admin);
        $soft_del->roles()->attach($client_admin);

        ### inactive users
        $inactive_users = new Route();
        $inactive_users->route_name = 'Inactive Users';
        $inactive_users->url = 'inactive-users';
        $inactive_users->parent_route = $reg_id;
        $inactive_users->save();
        $inactive_users->roles()->attach($admin);
        $inactive_users->roles()->attach($client_admin);

        ### permanently delete user
        $delete = new Route();
        $delete->route_name = 'Delete Masterfile Details';
        $delete->url = 'delete-masterfile/{id}';
        $delete->parent_route = $reg_id;
        $delete->save();
        $delete->roles()->attach($admin);
        $delete->roles()->attach($client_admin);

        ### restore inactive users
        $restore = new Route();
        $restore->route_name = 'Restore Inactive Users';
        $restore->url = 'restore-mf/{id}';
        $restore->parent_route = $reg_id;
        $restore->save();
        $restore->roles()->attach($admin);
        $restore->roles()->attach($client_admin);

        ### users profile
        $profile = new Route();
        $profile->route_name = 'Users Profile';
        $profile->url = 'mf-profile/{id}';
        $profile->parent_route = $reg_id;
        $profile->save();
        $profile->roles()->attach($admin);
        $profile->roles()->attach($client_admin);

        ### permanently delete user address
        $del_addr = new Route();
        $del_addr->route_name = 'Delete Users Address Details';
        $del_addr->url = 'delete-address/{id}';
        $del_addr->parent_route = $reg_id;
        $del_addr->save();
        $del_addr->roles()->attach($admin);
        $del_addr->roles()->attach($client_admin);

        ### adding a new address for a user
        $add_addr = new Route();
        $add_addr->route_name = 'Add New Address Details';
        $add_addr->url = 'add-address/{id}';
        $add_addr->parent_route = $reg_id;
        $add_addr->save();
        $add_addr->roles()->attach($admin);
        $add_addr->roles()->attach($client_admin);

        #### Application
        $app = new Route();
        $app->route_name = 'First Applications';
        $app->save();
        $app_id = $app->id;

        #### Application children
        $all_app = new Route();
        $all_app->route_name = 'All First Applications';
        $all_app->url = 'all_applications';
        $all_app->parent_route = $app_id;
        $all_app->save();
        $all_app->roles()->attach($admin);
        $all_app->roles()->attach($client_admin);

        $all_app = new Route();
        $all_app->route_name = 'Approve Applications';
        $all_app->url = 'approve-applications';
        $all_app->parent_route = $app_id;
        $all_app->save();
        $all_app->roles()->attach($admin);
        $all_app->roles()->attach($client_admin);

        $all_app = new Route();
        $all_app->route_name = 'Reject Applications';
        $all_app->url = 'reject-applications';
        $all_app->parent_route = $app_id;
        $all_app->save();
        $all_app->roles()->attach($admin);
        $all_app->roles()->attach($client_admin);

        $all_app = new Route();
        $all_app->route_name = 'Load All Applications';
        $all_app->url = 'all_applications/fas';
        $all_app->parent_route = $app_id;
        $all_app->save();
        $all_app->roles()->attach($admin);
        $all_app->roles()->attach($client_admin);

        $pend_app = new Route();
        $pend_app->route_name = 'Pending Application';
        $pend_app->url = 'pending_applications';
        $pend_app->parent_route = $app_id;
        $pend_app->save();
        $pend_app->roles()->attach($admin);
        $pend_app->roles()->attach($client_admin);

        $pend_app = new Route();
        $pend_app->route_name = 'Loading Pending Application';
        $pend_app->url = 'pending_applications/pending';
        $pend_app->parent_route = $app_id;
        $pend_app->save();
        $pend_app->roles()->attach($admin);
        $pend_app->roles()->attach($client_admin);

        $canc_app = new Route();
        $canc_app->route_name = 'Cancelled Application';
        $canc_app->url = 'canceled_applications';
        $canc_app->parent_route = $app_id;
        $canc_app->save();
        $canc_app->roles()->attach($admin);
        $canc_app->roles()->attach($client_admin);

        $canc_app = new Route();
        $canc_app->route_name = 'Cancelled Application';
        $canc_app->url = 'canceled_applications/canceled';
        $canc_app->parent_route = $app_id;
        $canc_app->save();
        $canc_app->roles()->attach($admin);
        $canc_app->roles()->attach($client_admin);

        $appr_app = new Route();
        $appr_app->route_name = 'Approved Application';
        $appr_app->url = 'approved_applications';
        $appr_app->parent_route = $app_id;
        $appr_app->save();
        $appr_app->roles()->attach($admin);
        $appr_app->roles()->attach($client_admin);


        $appr_app = new Route();
        $appr_app->route_name = 'Load Approved Application';
        $appr_app->url = 'approved_applications/approved';
        $appr_app->parent_route = $app_id;
        $appr_app->save();
        $appr_app->roles()->attach($admin);
        $appr_app->roles()->attach($client_admin);


        ##second applications
        $app = new Route();
        $app->route_name = 'Second Applications';
        $app->save();
        $app_id = $app->id;
        //all second applications
        $all_app = new Route();
        $all_app->route_name = 'All Second Applications';
        $all_app->url = 'list-second-application';
        $all_app->parent_route = $app_id;
        $all_app->save();
        $all_app->roles()->attach($admin);
        $all_app->roles()->attach($client_admin);

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
        $item->roles()->attach($client_admin);

        $item = new Route();
        $item->route_name = 'Manage Categories';
        $item->url = 'inventory-categories';
        $item->parent_route = $inventory_id;
        $item->save();
        $item->roles()->attach($admin);
        $item->roles()->attach($client_admin);

        $category = new Route();
        $category->route_name = 'Inventory Allocation';
        $category->url = 'all-allocations';
        $category->parent_route = $inventory_id;
        $category->save();
        $category->roles()->attach($admin);
        $category->roles()->attach($client_admin);

        $category = new Route();
        $category->route_name = 'Arrange Menu';
        $category->url = 'arrange-menu';
        $category->parent_route = $inventory_id;
        $category->save();
        $category->roles()->attach($admin);
        $category->roles()->attach($client_admin);

        $category = new Route();
        $category->route_name = 'Get Menu Menu';
        $category->url = 'get-menu/{id}';
        $category->parent_route = $inventory_id;
        $category->save();
        $category->roles()->attach($admin);
        $category->roles()->attach($client_admin);

        $category = new Route();
        $category->route_name = 'get make';
        $category->url = '/subcats/{id}';
        $category->parent_route = $inventory_id;
        $category->save();
        $category->roles()->attach($admin);
        $category->roles()->attach($client_admin);

        $category = new Route();
        $category->route_name = 'Manage Motorbikes';
        $category->url = '/bikes';
        $category->parent_route = $inventory_id;
        $category->save();
        $category->roles()->attach($admin);
        $category->roles()->attach($client_admin);

        $model = new Route();
        $model->route_name = 'Motorbikes Models';
        $model->url = '/bikes-model';
        $model->parent_route = $inventory_id;
        $model->save();
        $model->roles()->attach($admin);
        $model->roles()->attach($client_admin);

        $category = new Route();
        $category->route_name = 'Stock Transactions';
        $category->url = '/stock-transactions';
        $category->parent_route = $inventory_id;
        $category->save();
        $category->roles()->attach($admin);
        $category->roles()->attach($client_admin);

        $insurance = new Route();
        $insurance->route_name = 'Bike Insurance';
        $insurance->url = '/bike-insurance/{id}';
        $insurance->parent_route = $inventory_id;
        $insurance->save();
        $insurance->roles()->attach($admin);
        $insurance->roles()->attach($client_admin);

        #### client
        $client = new Route();
        $client->route_name = 'Client';
        $client->save();
        $client_id = $client->id;

        #### client children
        $acc = new Route();
        $acc->route_name = 'Client Accounts';
        $acc->url = 'client_account';
        $acc->parent_route = $client_id;
        $acc->save();
        $acc->roles()->attach($admin);
        $acc->roles()->attach($client_admin);

        $wallet = new Route();
        $wallet->route_name = 'Client Wallet';
        $wallet->url = 'client_wallet';
        $wallet->parent_route = $client_id;
        $wallet->save();
        $wallet->roles()->attach($admin);
        $wallet->roles()->attach($client_admin);

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
        $service_category->roles()->attach($client_admin);

        ### rider wallet Profile
        $wallet = new Route();
        $wallet->route_name = 'Manage My Wallet';
        $wallet->url = 'my-wallet';
        $wallet->parent_route = $reg_id;
        $wallet->save();
        $wallet->roles()->attach($admin);
        $wallet->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Add Service Category';
        $route->url = 'add-sc-cats';
        $route->parent_route = $service_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Get Service Category';
        $route->url = 'get-scat-details/{id}';
        $route->parent_route = $service_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Update Service Category';
        $route->url = 'edit-sc-cats';
        $route->parent_route = $service_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Delete Service Category';
        $route->url = 'delete-scats';
        $route->parent_route = $service_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $manage_service = new Route();
        $manage_service->route_name = 'Manage Services';
        $manage_service->url = 'manage_services';
        $manage_service->parent_route = $service_id;
        $manage_service->save();
        $manage_service->roles()->attach($admin);
        $manage_service->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Add Service';
        $route->url = 'add-service';
        $route->parent_route = $service_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Update Service';
        $route->url = 'update-service';
        $route->parent_route = $service_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Get Service';
        $route->url = 'get-service/{id}';
        $route->parent_route = $service_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Delete Service';
        $route->url = 'delete-service';
        $route->parent_route = $service_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

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
        $all_bills->roles()->attach($client_admin);

        $pending_bills = new Route();
        $pending_bills->route_name = 'Pending Bills';
        $pending_bills->url = 'pending_bills';
        $pending_bills->parent_route = $bp_id;
        $pending_bills->save();
        $pending_bills->roles()->attach($admin);
        $pending_bills->roles()->attach($client_admin);

        $all_payments = new Route();
        $all_payments->route_name = 'All Payments';
        $all_payments->url = 'all_payments';
        $all_payments->parent_route = $bp_id;
        $all_payments->save();
        $all_payments->roles()->attach($admin);
        $all_payments->roles()->attach($client_admin);

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
        $daily->roles()->attach($client_admin);

        $weekly = new Route();
        $weekly->route_name = 'Weekly Summary Reports';
        $weekly->url = 'weekly_summary_report';
        $weekly->parent_route = $reports_id;
        $weekly->save();
        $weekly->roles()->attach($admin);
        $weekly->roles()->attach($client_admin);

        $monthly = new Route();
        $monthly->route_name = 'Monthly Summary Reports';
        $monthly->url = 'monthly_summary_report';
        $monthly->parent_route = $reports_id;
        $monthly->save();
        $monthly->roles()->attach($admin);
        $monthly->roles()->attach($client_admin);

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
        $routes->roles()->attach($client_admin);

        $routes = new Route();
        $routes->route_name = 'Load System Routes';
        $routes->url = 'load-routes';
        $routes->parent_route = $system_id;
        $routes->save();
        $routes->roles()->attach($admin);
        $routes->roles()->attach($client_admin);

        $menu = new Route();
        $menu->route_name = 'System Menu';
        $menu->url = 'menu';
        $menu->parent_route = $system_id;
        $menu->save();
        $menu->roles()->attach($admin);
        $menu->roles()->attach($client_admin);

        $system_config = new Route();
        $system_config->route_name = 'System Configuration';
        $system_config->url = 'sys-config';
        $system_config->parent_route = $system_id;
        $system_config->save();
        $system_config->roles()->attach($admin);
        $system_config->roles()->attach($client_admin);

        $system_config = new Route();
        $system_config->route_name = 'System Settings';
        $system_config->url = 'load-config';
        $system_config->parent_route = $system_id;
        $system_config->save();
        $system_config->roles()->attach($admin);
        $system_config->roles()->attach($client_admin);

        $system_config = new Route();
        $system_config->route_name = 'Get Route Data';
        $system_config->url = 'get-route/{route_id}';
        $system_config->parent_route = $system_id;
        $system_config->save();
        $system_config->roles()->attach($admin);
        $system_config->roles()->attach($client_admin);

        $system_config = new Route();
        $system_config->route_name = 'Update Route';
        $system_config->url = 'edit-route';
        $system_config->parent_route = $system_id;
        $system_config->save();
        $system_config->roles()->attach($admin);
        $system_config->roles()->attach($client_admin);

        $system_config = new Route();
        $system_config->route_name = 'Load System Configuration';
        $system_config->url = 'load-config';
        $system_config->parent_route = $system_id;
        $system_config->save();
        $system_config->roles()->attach($admin);
        $system_config->roles()->attach($client_admin);

        $theme_config = new Route();
        $theme_config->route_name = 'Theme Configuration';
        $theme_config->url = 'theme_config';
        $theme_config->parent_route = $system_id;
        $theme_config->save();
        $theme_config->roles()->attach($admin);
        $theme_config->roles()->attach($client_admin);

        $theme_config = new Route();
        $theme_config->route_name = 'Theme Select';
        $theme_config->url = 'theme-select/{theme}';
        $theme_config->parent_route = $system_id;
        $theme_config->save();
        $theme_config->roles()->attach($admin);
        $theme_config->roles()->attach($client_admin);

        $get_theme = new Route();
        $get_theme->route_name = 'Get Theme';
        $get_theme->url = 'get-theme';
        $get_theme->parent_route = $system_id;
        $get_theme->save();
        $get_theme->roles()->attach($admin);
        $get_theme->roles()->attach($client_admin);

        $backup = new Route();
        $backup->route_name = 'Backup';
        $backup->url = 'backup';
        $backup->parent_route = $system_id;
        $backup->save();
        $backup->roles()->attach($admin);
        $backup->roles()->attach($client_admin);

        #### user management
        $user_mngt = new Route();
        $user_mngt->route_name = 'User Management';
        $user_mngt->save();
        $user_mngt_id = $user_mngt->id;

        #### user management children
        $all_user = new Route();
        $all_user->route_name = 'All Users';
        $all_user->url = 'all_users';
        $all_user->parent_route = $user_mngt_id;
        $all_user->save();
        $all_user->roles()->attach($admin);
        $all_user->roles()->attach($client_admin);

        $roles = new Route();
        $roles->route_name = 'User Roles';
        $roles->url = 'user_roles';
        $roles->parent_route = $user_mngt_id;
        $roles->save();
        $roles->roles()->attach($admin);
        $roles->roles()->attach($client_admin);

        $role = new Route();
        $role->route_name = 'Delete User';
        $role->url = 'delete-user/{id}';
        $role->parent_route = $user_mngt_id;
        $role->save();
        $role->roles()->attach($admin);
        $role->roles()->attach($client_admin);

        $role = new Route();
        $role->route_name = 'Block User';
        $role->url = 'all_users/block-user';
        $role->parent_route = $user_mngt_id;
        $role->save();
        $role->roles()->attach($admin);
        $role->roles()->attach($client_admin);

        $role = new Route();
        $role->route_name = 'Unblock User';
        $role->url = 'all_users/unblock-user';
        $role->parent_route = $user_mngt_id;
        $role->save();
        $role->roles()->attach($admin);
        $role->roles()->attach($client_admin);

        $audit_trail = new Route();
        $audit_trail->route_name = 'Audit Trail';
        $audit_trail->url = 'audit_trails';
        $audit_trail->parent_route = $user_mngt_id;
        $audit_trail->save();
        $audit_trail->roles()->attach($admin);
        $audit_trail->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Load Routes Allocation';
        $route->url = 'load-routes-allocation';
        $route->parent_route = $system_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'is Route Allocated';
        $route->url = 'check-allocated-route/{id}';
        $route->parent_route = $system_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Attach Route';
        $route->url = 'attach-route';
        $route->parent_route = $system_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Detach Route';
        $route->url = 'detach-route';
        $route->parent_route = $system_id;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        #### Bills and Payments

        $route = new Route();
        $route->route_name = 'Bills And Payments';
        $route->save();
        $bps_parent = $route->id;

        $route = new Route();
        $route->route_name = 'Customer Bills';
        $route->url = 'customer-bills';
        $route->parent_route = $bps_parent;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);

        $route = new Route();
        $route->route_name = 'Load Customer Bills';
        $route->url = 'load-customer-bills';
        $route->parent_route = $bps_parent;
        $route->save();
        $route->roles()->attach($admin);
        $route->roles()->attach($client_admin);
    }
}