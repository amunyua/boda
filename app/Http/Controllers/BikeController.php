<?php

namespace App\Http\Controllers;

use App\Bike;
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
        $mk = Category::where('code','BIKE')->first();
        $categories = Category::where('parent_category','=',$mk->id)->get();
        return view('inventory.bikes',array(
            'categories'=>$categories
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        var_dump($_POST);die;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        var_dump($_POST);die;
        $this->validate($request,array(
           'make'=>'required',
//            'model'=>'required',
            'vin'=>'required',
            'chassis_number'=>'required',
            'cost_price'=>'required'
        ));
        $bike = new Bike();
        $bike->vin = strtoupper($request->vin);
        $bike->price = $request->cost_price;
        $bike->model = $request->make;
        $bike->make = $request->make;
        $bike->chassis_number = $request->chassis_number;

        try{
            $bike->save();
            Session::flash('success','The bike('.$request->vin.') has been added');
        }catch (e $e){
            $this->handleException2($e);
        }
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            ->editColumn('make',
                '@if(!empty($make))
            {{ App\Category::find($make)->category_name}}
            @endif
            ')
            ->editColumn('model',
                '@if(!empty($model))
            {{ App\Category::find($model)->category_name}}
            @endif
            ')
            ->make(true);
    }
}
