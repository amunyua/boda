<?php

namespace App\Http\Controllers;

use App\Bike;
use App\BikeModel;
use App\Category;
use Illuminate\Database\QueryException as e;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;


class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = BikeModel::all();
        return view('inventory.bikes',array(
            'models'=>$models
        ));
    }

    public function store(Request $request)
    {
//        var_dump($_POST);die;
        $this->validate($request,array(
            'model'=>'required',
            'vin'=>'required|unique:bikes,vin',
            'chassis_number'=>'required|unique:bikes,chassis_number',
            'cost_price'=>'required'
        ));
        $bike = new Bike();
        $bike->vin = strtoupper($request->vin);
        $bike->price = $request->cost_price;
        $bike->model = $request->model;
        $bike->chassis_number = $request->chassis_number;

        try{
            $bike->save();
            Session::flash('success','The bike('.$request->vin.') has been added');
        }catch (e $e){
            Session::flash('warning',$e->errorInfo[2]);
        }
        return redirect()->back();
    }


    public function destroy(Request $request)
    {
        $delete_ids = [$request->edit_ids];
        try{
            Bike::destroy($delete_ids);
            Session::flash('success','The Motorbike has been deleted');
        }catch (e $e){
            Session::flash('failed','Can not delete this record for it\'s being used somewhere else');
        }
        return redirect()->back();
    }

    public function getBikes(){
        $results = Bike::all();
        return Datatables::of($results)
            ->editColumn('status','
            @if($status == 1)
                Active
                @else
                Inactive
            @endif
            ')
            ->editColumn('price',
                '{{number_format($price,2)}}')

//            ->editColumn('model',
//                '@if(!empty($model))
//            {{ App\BikeModel::find($model)->model}}
//            @endif
//            ')
            ->addColumn('attach_insurance', function($result){
                return '<a href="'.url('bikes/bike_insurance/'.$result->id).'" class="btn btn-primary"><i class="fa fa-paperclip"></i> Attach Insurance</a>';
            })
            ->make(true);

    }

    public function allBikeModel(){
        $models = BikeModel::all();
        return view('inventory.bike_model',array(
            'model'=>$models
        ));
    }

    public function loadBikeInsurance(Request $request){
        $ins_id = $request->id;
        $ins = Bike::find($ins_id);
        return view('inventory.bike_insurance', [
            'ins' => $ins
        ]);
    }

    public function addModel(Request $request){
//        var_dump($_POST);die;
        $this->validate($request,array(
            'model'=>'required',
            'status'=>'required'
        ));

        $model = new BikeModel();
        $model->model = $request->model;
        $model->status = $request->status;
            try {
                $model->save();
            } catch (QueryException $e) {
                Session::flash('error', $e->getMessage());
            }

        return redirect()->back();
    }

    public function editBikeModel(Request $request){
//        var_dump($_POST);die;
        $this->validate($request, array(
            'model'=>'required',
            'status'=>'required'
        ));

        $record = BikeModel::find($request->edit_id);
        if(empty($record)){
            Session::flash('failed','Bike Model details not updated!');
        }else {
            $record->model = $request->model;
            $record->status = $request->status;

            try {
//                $this->recordAuditTrail();
                $record->save();
                Session::flash('success', 'The Bike Model has been updated');
            } catch (e $e) {
                Session::flash('failed', 'Encountered an error');
            }
        }
        return redirect()->back();
    }

    public function getEditDetails($id){
        $records = BikeModel::find($id);
        return Response::json($records);
    }

    public function destroyBikeModel(Request $request){
        $delete_ids = [$request->edit_ids];
        try{
            BikeModel::destroy($delete_ids);
            Session::flash('success','The Bike Model has been deleted');
        }catch (e $e){
            $this->handleException2($e);
        }
        return redirect()->back();
    }
    public function getAllBikeModels(){
        $model = BikeModel::all();
        return Datatables::of($model)
            ->editColumn('status','
            @if($status == 1)
                Active
                @else
                Inactive
            @endif
            ')
            ->make(true);
    }

    public function attachBikeInsurance(Request $request){
       // var_dump($_POST);die;
        $this->validate($request, array(
            'insurance_name'=>'required',
            'insurance_company_name'=>'required',
            'issue_date'=>'required',
            'expiry_date'=>'required',
            'status'=>'required'
        ));

        $record = BikeModel::find($request->edit_id);

        $results_set = BikeModel::where([
            ['id',$record->id]
        ])->get();
        $results = $results_set->toArray();

//        var_dump($results);die;
        if($results){
            Session::flash('failed','Failed to Attach Insurance to a Bike!');
        }else {
            $record->insurance_name = $request->insurance_name;
            $record->insurance_company_name = $request->insurance_company_name;
            $record->issue_date = $request->issue_date;
            $record->expiry_date = $request->expiry_date;
            $record->status = $request->status;

            try {
                $this->recordAuditTrail();
                $record->save();
                Session::flash('success', 'The Bike Insurance has been attached');
            } catch (e $e) {
                Session::flash('failed', 'Encountered an error');
            }
        }
        return redirect()->back();
    }

    public function getBikeEditDetails($id){
        $details = Bike::find($id);
        return Response::json($details);
    }
}