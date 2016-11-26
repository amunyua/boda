<?php

namespace App\Http\Controllers;

use App\AuditTrail;
use App\Role;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use SmoDav\Mpesa\Native\Mpesa;
use Yajra\Datatables\Facades\Datatables;
use App\Route;

class UserManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function mpesaPayment(){
        $repsonse = mpesa(10, 254715862938)->usingReferenceId('Alex Muunyua')->transact();
        return Guz::json($repsonse);
    }
    public function getIndex(){
        $roles = Role::all();
        return view('user_manager.user_roles')->withRoles($roles);
    }

    public function storeRole(Request $request){
//        var_dump($_POST);

        $this->validate($request,array(
            'role_name'=>'required|min:3|unique:roles,role_name',
            'role_code'=>'required|min:3|unique:roles,role_code',
            'status'=>'required'
        ));
        try {
            $user_role = new Role();
            $user_role->role_name = $request->role_name;
            $user_role->role_code = strtoupper($request->role_code);
            $user_role->role_status = $request->status;
            $user_role->save();
            Session::flash('success','User Role ('.$request->role_name.') has been added');
        } catch (\Illuminate\Database\QueryException $e) {
             $message =  $this->handleException($e);
//            var_dump($message);
            Session::flash('warning', $message);
//            return redirect()->back()->withInput();
        }
        return redirect('user_roles');
    }

    public function destroyRole($id){
        if(Role::destroy($id)){
//            $this->logAction('Delete_user_role');
            Session::flash('success','Role has been deleted');
            return redirect('user_roles');
        }
    }

    public function auditTrails(){
//        $audit_trails = AuditTrail::all();
        return view('user_manager.audit_trails');
    }
    public function ajaxAuditTrails(){
//        $audit_trails = AuditTrail::all();
        return Datatables::of(AuditTrail::all()->make(true));
    }

    public function loadRoutesForAllocation(){
        $routes = Route::whereNotNull('parent_route')->where('route_status', 1);
        return Datatables::of($routes)
            ->editColumn('route_status',
                '@if($route_status)
                Active 
            @else
                Inactive
            @endif')
            ->editColumn('parent_route',
                '@if(!empty($parent_route))
                {{ App\Route::find($parent_route)->route_name }}
            @endif')
            ->addColumn('attach_detach', function($route){
                return '<input type="checkbox" class="attach custom_checkbox" value="'.$route->id.'" role-id=""/>';
            })
            ->make(true);
    }

    public function attachRoute(Request $request){
//        var_dump($request->route_id);exit;
        $route = Route::find($request->route_id);
        $route->roles()->attach($request->role_id);
        return Response::json([
            'success' => true,
            'message' => 'Route has been allocated!'
        ]);
    }

    public function getRoleEditDetails($id){
        $role = Role::find($id);
        return Response::json($role);
    }

    public function updateUserRoleDetails(Request $request, $id){
        $this->validate($request, array(
            'role_name'=>'required',
            'role_code'=>'required',
            'status'=>'required'
        ));

        $role = Role::find($id);
        $role->role_name = $request->role_name;
        $role->role_code = $request->role_code;
        $role->role_status = $request->status;

        try{
            $role->save();
            Session::flash('success','The user role has been updated');
        } catch (\Illuminate\Database\QueryException $e){
            $message = $this->handleException($e);
            Session::flash('warning',$message);
        }
        return redirect('user_roles');
    }
}
