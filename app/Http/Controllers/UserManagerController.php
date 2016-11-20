<?php

namespace App\Http\Controllers;

use App\AuditTrail;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;
use App\Route;

class UserManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getIndex(){
        $roles = UserRole::all();
        return view('user_manager.user_roles')->withRoles($roles);
    }

    public function storeRole(Request $request){
//        var_dump($_POST);

        $this->validate($request,array(
            'role_name'=>'required|min:3|unique:user_roles,role_name',
            'status'=>'required'
        ));
//        $this->logAction('add_user_role');
        $user_role = new UserRole();
        $user_role->role_name = $request->role_name;
        $user_role->status = $request->status;

        $user_role->save();
        Session::flash('success','User Role ('.$request->role_name.') has been added');
        return redirect('user_roles');
    }

    public function destroyRole($id){
        if(UserRole::destroy($id)){
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
            ->addColumn('attach_detach', function(){
                return '<input type="checkbox" class="attach custom_checkbox"/>';
            })
            ->make(true);
    }
}
