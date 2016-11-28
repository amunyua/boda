<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

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
            // get the exception message and flash it out as an error or just pass a user friendly error
            $request->session()->flash('error', 'Encoutered a system error!'); // a user friendly error

            // redirection
            return redirect('/service_category');
        }
    }

    public function getScat(Request $request){
        $scat_id = $request->id;
        $scat = ServiceCategory::find($scat_id);
        return Response::json([$scat]);
    }

    public function update(Request $request){
        $this->validate($request, [
            'service_category_name' => 'required|unique:service_categories,service_category_name,'.$request->edit_id.'|max:255',
            'service_category_code' => 'required|unique:service_categories,service_category_code,'.$request->edit_id.'|max:255',
            'status' => 'required|boolean'
        ]);

        try{
            ServiceCategory::where('id', $request->edit_id)
                ->update([
                    'service_category_name' => $request->service_category_name,
                    'service_category_code' => $request->service_category_code,
                    'service_category_status' => $request->status
                ]);

            // success message
            $request->session()->flash('status', 'Service Category has been updated');

            // redirection
            return redirect('/service_category');
        }catch (QueryException $qe){
            $request->session()->flash('error', 'Encoutered a system error!'); // a user friendly error
            return redirect('/service_category');
        }
    }

    public function destroy(Request $request){
        $edit_ids = [$request->edit_ids];

        try{
            ServiceCategory::destroy($edit_ids);

            // success message
            $request->session()->flash('status', 'Service Category has been deleted');

            // redirection
            return redirect('/service_category');
        }catch (QueryException $qe){
            $request->session()->flash('error', 'Encoutered a system error!'); // a user friendly error
            return redirect('/service_category');
        }
    }
}
