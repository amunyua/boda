<?php

namespace App\Http\Controllers;

use App\Contact;
use App\FirstApplication;
use Illuminate\Database\QueryException;
use App\ContactTypes;
use App\County;
use App\Masterfile;
use App\Role;
use App\Address;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Facades\Datatables;

class MasterfileController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        $roles = Role::all();
        $main_ctype = ContactTypes::where('contact_type_code', 'MAIN')->first();
        $counties = County::all();
//        $streams = Stream::where('stream_status', 1)->get();

        return view('registration.index', array(
            'roles' => $roles,
            'main_ctype' => $main_ctype,
            'counties' => $counties,
//            'streams' => $streams
        ));
    }

    public function store(Request $request){
        $rules = array(
            'b_role' => 'required',
            'id_no' => 'required|unique:masterfiles',
            'firstname' => 'required',
            'surname' => 'required',
            'registration_date' => 'required',
            'role' => 'required',
            'email' => 'required',
            'county' => 'required',
            'town' => 'required',
            'phone_no' => 'required',
            'postal_address' => 'required',
            'postal_code' => 'required',
            'contact_type' => 'required'
        );

        switch ($request->b_role) {
            case 'Administrator':
                $this->addAdmin();
                break;

            case 'Staff':
                $this->addStaff();
                break;

            case 'Client':
                //var_dump($_POST);exit;
                $this->addClient();
                break;
        }
        return redirect('registration');
    }

    public function addAdmin(){
        DB::transaction(function(){
            try{
                // upload image if exists
                $path = '';
                if(Input::hasFile('image_path')){
                    $prefix = uniqid();
                    $image = Input::file('image_path');
                    $filename = $image->getClientOriginalName();
                    $new_name = $prefix.$filename;

                    if($image->isValid()) {
                        $image->move('uploads/images', $new_name);
                        $path = 'uploads/images/'.$new_name;
                    }
                }

                Log::info($path);

                Log::info('Creating Masterfile...', $_POST);
                $reg_date = date('Y-m-d', strtotime(Input::get('registration_date')));

                // add to db
                $mf = Masterfile::create(array(
                    'surname' => Input::get('surname'),
                    'firstname' => Input::get('firstname'),
                    'middlename' => Input::get('middlename'),
                    'email' => Input::get('email'),
                    'id_no' => Input::get('id_no'),
                    'b_role' => Input::get('b_role'),
                    'gender' => Input::get('gender'),
                    'user_role' => Input::get('role'),
                    'registration_date' => $reg_date,
                    'image_path' => $path,
                    'status' => 1
                ));
                $mf->save();
                Log::info('Created Masterfile');

                $mf_id = $mf->id;
                Log::info('Returned MF#: '.$mf_id);

                Log::info('Creating Address...');
                // add address details
                $address = Address::create(array(
                    'county' => Input::get('county'),
                    'city' => Input::get('city'),
                    'masterfile_id' => $mf_id,
                    'contact_type_id' => Input::get('contact_type_id'),
                    'email' => Input::get('email'),
                    'phone_no' => Input::get('phone_no'),
                    'tel_no' => Input::get('tel_no'),
                    'postal_address' => Input::get('postal_address'),
                    'postal_code' => Input::get('postal_code'),
                    'physical_address' => Input::get('physical_address')
                ));

                $address->save();
                Log::info('Created Address');

                Log::info('Creating Login Account');
                // create user login account
                $password = sha1(123456);
                $full_name = $mf->surname.' '.$mf->firstname;
                $login = User::create(array (
                    'name' => $full_name,
                    'email' => Input::get('email'),
                    'password' => $password,
                    'masterfile_id' => $mf_id,
                    'phone_no' => Input::get('phone_no')
                ));
                //print_r($login);exit;
                $login->save();
                Log::info('Created Login Account');

                // get user role
                $role_id = Input::get('role');

                // find the the instance of the role
                $user_role = Role::find($role_id);

                Log::info('Attaching User Role...');
                // attach the user role
                $login->roles()->attach($user_role);
                Log::info('Attached User Role');

            }catch (QueryException $qe){
                // get the exception message and flash it out as an error
                Session::flash('error', $qe->getMessage()); // a user friendly error
            }
        });

        Session::flash('success', 'System Administrator '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

    public function addStaff(){
        DB::transaction(function(){
           try{
                // upload image if exists
                $path = '';
                if(Input::hasFile('image_path')){
                    $prefix = uniqid();
                    $image = Input::file('image_path');
                    $filename = $image->getClientOriginalName();
                    $new_name = $prefix.$filename;

                    if($image->isValid()) {
                        $image->move('uploads/images', $new_name);
                        $path = 'uploads/images/'.$new_name;
                    }
                }

                Log::info($path);

                Log::info('Creating Masterfile...', $_POST);
                $reg_date = date('Y-m-d', strtotime(Input::get('registration_date')));

                // add to db
                $mf = Masterfile::create(array(
                    'surname' => Input::get('surname'),
                    'firstname' => Input::get('firstname'),
                    'middlename' => Input::get('middlename'),
                    'email' => Input::get('email'),
                    'id_no' => Input::get('id_no'),
                    'b_role' => Input::get('b_role'),
                    'gender' => Input::get('gender'),
                    'user_role' => Input::get('role'),
                    'registration_date' => $reg_date,
                    'image_path' => $path,
                    'status' => 1
                ));
                $mf->save();
                Log::info('Created Masterfile');

                $mf_id = $mf->id;
                Log::info('Returned MF#: '.$mf_id);

                Log::info('Creating Address...');
                // add address details
                $address = Address::create(array(
                    'county' => Input::get('county'),
                    'city' => Input::get('city'),
                    'masterfile_id' => $mf_id,
                    'contact_type_id' => Input::get('contact_type_id'),
                    'email' => Input::get('email'),
                    'phone_no' => Input::get('phone_no'),
                    'tel_no' => Input::get('tel_no'),
                    'postal_address' => Input::get('postal_address'),
                    'postal_code' => Input::get('postal_code'),
                    'physical_address' => Input::get('physical_address')
                ));

                $address->save();
                Log::info('Created Address');

                Log::info('Creating Login Account');
                // create user login account
                $password = sha1(123456);
                $full_name = $mf->surname.' '.$mf->firstname;
                $login = User::create(array (
                    'name' => $full_name,
                    'email' => Input::get('email'),
                    'password' => $password,
                    'masterfile_id' => $mf_id,
                    'phone_no' => Input::get('phone_no')
                ));
//                var_dump($login);exit;
                $login->save();
                Log::info('Created Login Account');

                // get user role
                $role_id = Input::get('role');

                // find the the instance of the role
                $user_role = Role::find($role_id);

                Log::info('Attaching User Role...');
                // attach the user role
                $login->roles()->attach($user_role);
                Log::info('Attached User Role');

            }catch (QueryException $qe){
                // get the exception message and flash it out as an error
                Session::flash('error', $qe->getMessage()); // a user friendly error
            }
        });

        Session::flash('success', 'Staff '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

    public function addClient(){
        DB::transaction(function(){
            try{
                // upload image if exists
                $path = '';
                if(Input::hasFile('image_path')){
                    $prefix = uniqid();
                    $image = Input::file('image_path');
                    $filename = $image->getClientOriginalName();
                    $new_name = $prefix.$filename;

                    if($image->isValid()) {
                        $image->move('uploads/images', $new_name);
                        $path = 'uploads/images/'.$new_name;
                    }
                }

                Log::info($path);

                Log::info('Creating Masterfile...', $_POST);
                $reg_date = date('Y-m-d', strtotime(Input::get('registration_date')));

                // add to db
                $mf = Masterfile::create(array(
                    'surname' => Input::get('surname'),
                    'firstname' => Input::get('firstname'),
                    'middlename' => Input::get('middlename'),
                    'email' => Input::get('email'),
                    'id_no' => Input::get('id_no'),
                    'b_role' => Input::get('b_role'),
                    'gender' => Input::get('gender'),
                    'user_role' => Input::get('role'),
                    'registration_date' => $reg_date,
                    'image_path' => $path,
                    'status' => 1
                ));
                $mf->save();
                Log::info('Created Masterfile');

                $mf_id = $mf->id;
                Log::info('Returned MF#: '.$mf_id);

                Log::info('Creating Address...');
                // add address details
                $address = Address::create(array(
                    'county' => Input::get('county'),
                    'city' => Input::get('city'),
                    'masterfile_id' => $mf_id,
                    'contact_type_id' => Input::get('contact_type_id'),
                    'email' => Input::get('email'),
                    'phone_no' => Input::get('phone_no'),
                    'tel_no' => Input::get('tel_no'),
                    'postal_address' => Input::get('postal_address'),
                    'postal_code' => Input::get('postal_code'),
                    'physical_address' => Input::get('physical_address')
                ));

                $address->save();
                Log::info('Created Address');

                Log::info('Creating Login Account');
                // create user login account
                $password = sha1(123456);
                $full_name = $mf->surname.' '.$mf->firstname;
                $login = User::create(array (
                    'name' => $full_name,
                    'email' => Input::get('email'),
                    'password' => $password,
                    'masterfile_id' => $mf_id,
                    'phone_no' => Input::get('phone_no')
                ));
                //print_r($login);exit;
                $login->save();
                Log::info('Created Login Account');

                // get user role
                $role_id = Input::get('role');

                // find the the instance of the role
                $user_role = Role::find($role_id);

                Log::info('Attaching User Role...');
                // attach the user role
                $login->roles()->attach($user_role);
                Log::info('Attached User Role');

            }catch (QueryException $qe){
                // get the exception message and flash it out as an error
                Session::flash('error', $qe->getMessage()); // a user friendly error
            }
        });

        Session::flash('success', 'Client '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

    public function allMfs(){
        $mfs = DB::table('all_masterfile')->where('status', '=', 1)->get();
        return view('registration.all_mfs', [
            'mfs' => $mfs
        ]);
    }

    public function getMf(Request $request){
        $mf_id = $request->id;
        $masterfile_id = $mf_id;
        $mf =  Masterfile::find($mf_id);
        $ad =  Address::find($masterfile_id);

        return view('registration.edit_mf', [
            'mf' => $mf,
            'ad' => $ad
        ]);
    }

    public function updateMf(Request $request, $id){
            try {
                // validate
                $this->validate($request, array(
                    'postal_address' => 'required',
                    'postal_code' => 'required',
                    'physical_address' => 'required'
                ));

                // upload image if exists
                $path = '';
                if (Input::hasFile('image_path')) {
                    $prefix = uniqid();
                    $image = Input::file('image_path');
                    $filename = $image->getClientOriginalName();
                    $new_name = $prefix . $filename;

                    if ($image->isValid()) {
                        $image->move('uploads/images', $new_name);
                        $path = 'uploads/images/' . $new_name;
                    }
                }
                // var_dump($path);exit;
                Log::info($path);

                Log::info('updating masterfile...', $_POST);
                // update masterfile record
                $mf = Masterfile::where('id', $id)
                    ->update(array(
                        'b_role' => $request->b_role,
                        'surname' => $request->surname,
                        'firstname' => $request->firstname,
                        'middlename' => $request->middlename,
                        'gender' => $request->gender,
                        'image_path' => $path,
                        'id_no' => $request->id_no,
                        'user_role' => $request->user_role
                    ));
                $mf->save();

                Log::info('updated masterfile');
                $mf_id = $mf->id;

                Log::info('updating address');
                // update address record
                $address = Address::where('id', $mf_id)
                    ->update(array(
                        'postal_address' => $request->postal_address,
                        'postal_code' => $request->postal_code,
                        'physical_address' => $request->physical_address,
                        'tel_no' => $request->tel_no
                    ));
                $address->save();
                Log::info('completed address');
            }catch (QueryException $msg){
                Session::flash('error', $msg->getMessage());
            }

        $request->session()->flash('success', 'User Registration has been updated');
        return redirect('edit-mf/'.$id);
    }

    public function softDeleteMf(Request $request, $id){
        // update db record
        $mf = Masterfile::find($id);
        $mf->status = 0;
        $mf->save();
        Session::flash('success', 'User Registration record has been deleted');
        return redirect('all-mfs');
    }

    public function loadDelMfs(){
        $mfs = DB::table('all_masterfile')->where('status', '=', 0)->get();
        return view('registration.all_inactive_users', [
            'mfs' => $mfs
        ]);
    }

    public function restoreMf(Request $request, $id){
        $mf = Masterfile::find($id);
        $mf->status = 1;
        $mf->save();
        Session::flash('success', 'User Registration Record has been RESTORED!');
        Return redirect('inactive-users');
    }

    public function destroy(Request $request, $id){
        //var_dump($_POST);exit;
        if(Masterfile::destroy($id)){
            Session::flash('success','User Registration Details Has Been Permanently DELETED!');
            return redirect('inactive-users');
        }
    }

    public function getMfProfile(Request $request){
        $mf_id = $request->id;
        $mf = Masterfile::find($mf_id);
        $address_id = $mf_id;
        $addr = Address::where('masterfile_id', $address_id)->first();
        $addresses = Address::where('masterfile_id', $address_id)->get();
        $ctype_id = $addr->contact_type_id;
        $ctype = ContactTypes::find($ctype_id)->first();
        //var_dump($ctype);die;
        $counties = County::all();
        $ctypes = ContactTypes::all();
        return view('registration.mf_profile', [
            'mf' => $mf,
            'addresses' => $addresses,
            'counties' => $counties,
            'addr' => $addr,
            'ctype' => $ctype,
            'ctypes' => $ctypes,
        ]);
    }

    public function getAllUsers(){
        $mfs = DB::select('select * from all_users where status = 1', [1]);

        return view('user_manager.all_users', ['mfs' => $mfs]);
    }

    public function addAddress(Request $request){
        $this->validate($request, array(
            'county'=> 'required',
            'city'=> 'required',
            'id'=> 'required',
            'postal_address'=> 'required',
            'physical_address'=> 'required',
            'postal_code'=> 'required',
            'phone_no'=> 'required'
        ));

        $address = new Address();

        $address->masterfile_id = $request->masterfile_id;
        $address->county = $request->county;
        $address->city = $request->city;
        $address->contact_type_id =$request->id;
        $address->postal_address =$request->postal_address;
        $address->postal_code =$request->postal_code;
        $address->phone_no =$request->phone_no;
        $address->physical_address =$request->physical_address;
        //print_r($address);die;
        $address->save();

        $request->session()->flash('success', 'New Address has been added');
        return redirect('mf-profile/'.$request->masterfile_id);
    }

    public function deleteAddress(Request $request, $id){
        //var_dump($_POST);exit;
        if(Address::destroy($id)){
            Session::flash('success','Address Details has been deleted');
            return redirect('mf-profile/'.+$request->masterfile_id);
//            return redirect('mf-profile/'.+$request->masterfile_id)->with('status', 'Address Details has been deleted!');
        }
    }

    public function allFirstApplications(){
        return view('registration.firstapplications');
    }

    public function pendingApplications(){
        return view('registration.pending-apps');
    }

    public function canceledApps(){
        return view('registration.canceled-apps');
    }

    public function approvedApps(){
        return view('registration.approved-apps');
    }

    public function firstApplications(){
        $fas = FirstApplication::query();
        return Datatables::of($fas)
            ->editColumn('approval_status', function ($fa){
                if($fa->approval_status == 1)
                    return '<span class="label label-success">Approved</span>';
                else if($fa->approval_status == 0)
                    return '<span class="label label-warning">Pending</span>';
                else
                    return '<span class="label label-danger">Rejected</span>';
            })
            ->make(true);
    }

    public function loadPendingApps(){
        $fas = FirstApplication::where('approval_status', 0);
        return Datatables::of($fas)
            ->editColumn('approval_status', function ($fa){
                if($fa->approval_status == 1)
                    return '<span class="label label-success">Approved</span>';
                else if($fa->approval_status == 0)
                    return '<span class="label label-warning">Pending</span>';
                else
                    return '<span class="label label-danger">Rejected</span>';
            })
            ->make(true);
    }

    public function loadCanceledApps(){
        $fas = FirstApplication::where('approval_status', 5);
        return Datatables::of($fas)
            ->editColumn('approval_status', function ($fa){
                if($fa->approval_status == 1)
                    return '<span class="label label-success">Approved</span>';
                else if($fa->approval_status == 0)
                    return '<span class="label label-warning">Pending</span>';
                else
                    return '<span class="label label-danger">Rejected</span>';
            })
            ->make(true);
    }

    public function loadApprovedApps(){
        $fas = FirstApplication::where('approval_status', 1);
        return Datatables::of($fas)
            ->editColumn('approval_status', function ($fa){
                if($fa->approval_status == 1)
                    return '<span class="label label-success">Approved</span>';
                else if($fa->approval_status == 0)
                    return '<span class="label label-warning">Pending</span>';
                else
                    return '<span class="label label-danger">Rejected</span>';
            })
            ->make(true);
    }

    public function approveApplication(Request $request){
        $ids = $request->app_no;
        $return = [];
        try {
            foreach ($ids as $id){
                FirstApplication::where('id', $id)
                    ->update([
                        'approval_status' => 1
                    ]);

                $candidate = FirstApplication::find($id);

                // send a email
                if(!empty($candidate->email)){

                }

                // send sms
            }

            $return = [
                'success' => true,
                'message' => 'The Application has been approved',
                'type' => 'success'
            ];
        } catch (QueryException $qe){
            $return = [
                'success' => false,
                'message' => $qe->getMessage(),
                'type' => 'error'
            ];
        }
        return Response::json($return);
    }

    public function rejectApplication(Request $request){
        $ids = $request->app_no;
        $return = [];
        try {
            foreach ($ids as $id){
                FirstApplication::where('id', $id)
                    ->update([
                        'approval_status' => 5
                    ]);

                $candidate = FirstApplication::find($id);

                // send a email
                if(!empty($candidate->email)){

                }

                // send sms
            }

            $return = [
                'success' => true,
                'message' => 'The Application has been canceled!',
                'type' => 'success'
            ];
        } catch (QueryException $qe){
            $return = [
                'success' => false,
                'message' => $qe->getMessage(),
                'type' => 'error'
            ];
        }
        return Response::json($return);
    }
}
