<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        $scs = ServiceCategory::all();

        return view('services.service_categories', [
            'scs' => $scs
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'service_category_name' => 'required|unique:service_categories',
            'service_category_code' => 'required|unique:service_categories',
            'status' => 'required|boolean'
        ]);

        try{
            $sc = new ServiceCategory();
            $sc->service_category_name = $request->service_category_name;
            $sc->service_category_code = $request->service_category_code;
            $sc->service_category_status = $request->status;
            $sc->save();

            // success message
            $request->session()->flash('status', 'Service Category has been added');

            // redirection
            return redirect('/service_category');
        }catch (QueryException $qe){
            // get the exception message and flash it out as an error
            $request->session()->flash('error', 'Encoutered a system error!'); // a user friendly error

            // redirection
            return redirect('/service_category');
        }
    }
}
