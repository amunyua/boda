<?php

namespace App\Http\Controllers;

use App\FirstApplication;
use App\Masterfile;
use App\Role;
use App\SecondApplication;
use App\User;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class SecondApplicationController extends Controller
{
    private $return;
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
        $sas = SecondApplication::all();
        return Datatables::of($sas)
            ->editColumn('status', function ($sa){
                if($sa->status == 0){
                    return '<span class="label label-warning">Pending</span>' ;
                }else{
                    return'<span class="label label-success">Approved</span>';
                }
            })
            ->editColumn('first_application_id',function ($app_name){
                $app_details = FirstApplication::find($app_name->id);
                return $app_details->surname.' '.$app_details->firstname.' '.$app_details->middlename;
            })
            ->make(true);
    }

    public function approveSecondApplication(Request $request){
        $ids = $request->app_no;
        DB::transaction(function () {
            $ids = Input::get('app_no');

            foreach ($ids as $id) {
//                    $status =SecondApplication::Where('id', $id)->first()->status;
//                    echo $status;die;
                if (SecondApplication::Where('id', $id)->first()->status == 1) {
                    $this->return = [
                        'success' => false,
                        'message' => "Application already approved",
                        'type' => 'error'
                    ];
                } else {


                    SecondApplication::where('id', $id)
                        ->update([
                            'status' => 1
                        ]);
                    $applicant_id = SecondApplication::find($id)->first_application_id;
                    $applicant_details = FirstApplication::find($applicant_id);
                    $masterfile = new Masterfile();
                    $masterfile->surname = $applicant_details->surname;
                    $masterfile->firstname = $applicant_details->firstname;
                    $masterfile->middlename = $applicant_details->middlename;
//                    $masterfile->id_no = $applicant_details->id_no;
                    $masterfile->registration_date = (!empty($applicant_details->created_at))? $applicant_details->created_at: NULL;
                    $masterfile->b_role = 'Client';
                    $user_role = Role::where('role_code', 'CLIENT')->first();
                    $masterfile->user_role = $user_role->id;
                    $masterfile->gender = $applicant_details->gender;
                    $masterfile->status = true;
                    $masterfile->phone_no = $applicant_details->phone_no;
                    $masterfile->documents_id = $id;
                    try {

                        $masterfile->save();
                        $masterfile_id = $masterfile->id;

                        //update user account details
                        $user_account = User::where('phone_no', $applicant_details->phone_no)
                            ->update(['masterfile_id'=>$masterfile_id]);

                        $this->return = [
                            'success' => true,
                            'message' => 'The Application has been approved',
                            'type' => 'success'
                        ];
                    } catch (QueryException $exception) {

                        $this->return = [
                            'success' => false,
                            'message' => $exception->getMessage(),
                            'type' => 'error'
                        ];
                    }
                }
            }
        }

                );

        return Response::json($this->return);
    }
}
