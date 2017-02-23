<?php

namespace App\Http\Controllers;

use App\SecondApplication;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class SecondApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('checkiffap');
    }

    public function index(){
        return view('second_application.second_application_index');
    }

    public function unApprovedFirstApplicationIndex(){
        return view(' second_application.first_app_ntapproved');
    }

    public function uploadDocuments(Request $request){
        $this->validate($request,array(
            'school_cert'=>'required',
            'religious_reference'=>'required',
            'government_character_reference'=>'required',
            'identification_card'=>'required',
            'good_conduct'=>'required'
        ));
//        print_r($_FILES);die;
        $second_app = new SecondApplication();
        foreach ($_FILES as $key=>$detail){
//            echo $key;
            $this->uploadFileDocument($key,$second_app);
        }
        $second_app->first_application_id = $this->user()->id;
        try{
            $second_app->save();
            Session::flash('success','Details have been uploaded');
        }catch (QueryException $e){
            $this->handleException2($e);
        }

        return redirect('second-application');

    }

    public function uploadFileDocument($name,$model){
        echo $name;
        if(Input::hasFile($name)){
            $prefix = uniqid();
            $image = Input::file($name);
            $filename = $image->getClientOriginalName();
            $fileclient = $image->getClientOriginalExtension();
            $new_name = md5($prefix.$filename).'.'.$fileclient;

            if($image->isValid()) {
                $image->move('uploads/documents/second_application', $new_name);
                $path = 'uploads/documents/second_application/'.$new_name;
                $model->$name = $path;
            }
        }
    }

    public function listSecondApplications(){
        return view('second_application.list_second_application');
    }

    public function getList(){
        return Datatables::of(SecondApplication::all())->make(true);
    }
}
