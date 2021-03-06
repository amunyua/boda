<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        $services = Service::all();
        $scs = ServiceCategory::all();
        return view('services.services', [
            'services' => $services,
            'scs' => $scs,
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'service_category' => 'required',
            'service_name' => 'required|unique:services',
            'service_code' => 'required|unique:services',
            'price' => 'required|numeric',
            'status' => 'required|boolean'
        ]);

        try {
            $service = new Service();
            $service->service_name = $request->service_name;
            $service->service_code = $request->service_code;
            $service->price = $request->price;
            $service->service_category_id = $request->service_category;
            $service->service_status = $request->status;
            $service->parent_service = (!empty($request->parent_service)) ? $request->parent_service : NULL;
            $service->save();

            $request->session()->flash('status', 'Service has been added');
            return redirect('/manage_services');
        } catch (QueryException $qe){
            $request->session()->flash('error', $qe->getMessage());
            return redirect('/manage_services');
        }
    }

    public function getService(Request $request){
        $id = $request->id;
        $service = Service::find($id);
        return Response::json($service);
    }

    public function update(Request $request){
        $this->validate($request, [
            'service_category' => 'required',
            'service_name' => 'required|unique:services,service_name,'.$request->edit_id,
            'service_code' => 'required|unique:services,service_code,'.$request->edit_id,
            'price' => 'required|numeric',
            'status' => 'required|boolean'
        ]);

        try{
            Service::where('id', $request->edit_id)
                ->update([
                    'service_category_id' => $request->service_category,
                    'service_name' => $request->service_name,
                    'service_code' => $request->service_code,
                    'price' => $request->price,
                    'parent_service' => (!empty($request->parent_service)) ? $request->parent_service : NULL,
                    'service_status' => $request->status
                ]);

            $request->session()->flash('status', 'Service has been updated');
            return redirect('/manage_services');
        } catch (QueryException $qe) {
            $request->session()->flash('error', $qe->getMessage());
            return redirect('/manage_services');
        }
    }

    public function destroy(Request $request){
        try {
            Service::destroy([$request->edit_ids]);
            $request->session()->flash('status', 'Service has been deleted');
        } catch (QueryException $qe) {
            $request->session()->flash('error', $qe->getMessage());
        }
        return redirect('/manage_services');
    }
}
