<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Datatables;

use App\Http\Requests;

class RoutesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('system.routes');
    }

    public function loadRoutes(){
        $routes = Route::all();
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
            ->make(true);
    }

    public function store(Request $request){
        // validation

    }

    public function update(Request $request){
        // validation

    }

    public function destroy(Request $request){
        if(Route::destroy($request->id)){
            $return = [
                'success' => true
            ];
        }else{
            $return = [
                'success' => false
            ];
        }
        return Response::json($return);
    }
}
