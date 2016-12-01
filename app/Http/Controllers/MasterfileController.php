<?php

namespace App\Http\Controllers;

use App\Contact;
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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

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
                //var_dump($path);exit;

                // add to db
                $mf = Masterfile::create(array(
                    'surname' => Input::get('surname'),
                    'firstname' => Input::get('firstname'),
                    'middlename' => Input::get('middlename'),
                    'email' => Input::get('email'),
                    'id_no' => Input::get('id_no'),
                    'b_role' => Input::get('b_role'),
                    'gender' => Input::get('gender'),
                    'user_role' => Input::get('user_role'),
                    'registration_date' => Input::get('registration_date'),
                    'image_path' => $path,
                    'status' => 1
                ));
                //var_dump($mf);exit;
                $mf->save();
                $mf_id = $mf->id;

                // add address details
                $address = Address::create(array(
                    'county' => Input::get('county'),
                    'city' => Input::get('city'),
                    'masterfile_id' => $mf_id,
                    'email' => Input::get('email'),
                    'phone_no' => Input::get('phone_no'),
                    'tel_no' => Input::get('tel_no'),
                    'postal_address' => Input::get('postal_address'),
                    'postal_code' => Input::get('postal_code'),
                    'physical_address' => Input::get('physical_address')
                ));
                $address->save();

                // create user login account
                $password = sha1(123456);
                $full_name = $mf->surname.' '.$mf->firstname;
                $login = User::create(array (
                    'masterfile_id' => $mf_id,
                    'email' => Input::get('email'),
                    'mobile_no' => Input::get('phone_no'),
                    'password' => $password,
                    'name' => $full_name
                ));
//            var_dump($login);exit;
                $login->save();
            }catch (QueryException $qe){
                // get the exception message and flash it out as an error
                Session::flash('error', $qe->getMessage()); // a user friendly error
            }
        });

        Session::flash('success', 'Administrator '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
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
                $role_id = Input::get('user_role');

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
                //var_dump($path);exit;

                // add to db
                $mf = Masterfile::create(array(
                    'surname' => Input::get('surname'),
                    'firstname' => Input::get('firstname'),
                    'middlename' => Input::get('middlename'),
                    'email' => Input::get('email'),
                    'id_no' => Input::get('id_no'),
                    'b_role' => Input::get('b_role'),
                    'gender' => Input::get('gender'),
                    'user_role' => Input::get('user_role'),
                    'registration_date' => Input::get('registration_date'),
                    'image_path' => $path,
                    'status' => 1
                ));
                //var_dump($mf);exit;
                $mf->save();
                $mf_id = $mf->id;

                // add address details
                $address = Address::create(array(
                    'county' => Input::get('county'),
                    'city' => Input::get('city'),
                    'masterfile_id' => $mf_id,
                    'email' => Input::get('email'),
                    'phone_no' => Input::get('phone_no'),
                    'tel_no' => Input::get('tel_no'),
                    'postal_address' => Input::get('postal_address'),
                    'postal_code' => Input::get('postal_code'),
                    'physical_address' => Input::get('physical_address')
                ));
                $address->save();

                // create user login account
                $password = sha1(123456);
                $full_name = $mf->surname.' '.$mf->firstname;
                $login = User::create(array (
                    'masterfile_id' => $mf_id,
                    'email' => Input::get('email'),
                    'phone_no' => Input::get('phone_no'),
                    'password' => $password,
                    'name' => $full_name
                ));
//            var_dump($login);exit;
                $login->save();
            }catch (QueryException $qe){
                // get the exception message and flash it out as an error
                Session::flash('error', $qe->getMessage()); // a user friendly error
            }
        });

        Session::flash('success', 'Client '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

    public function allMfs(){
        $mfs = DB::table('all_masterfile')->where('status', '=', 1)->get();
        return view('registration.all_mfs')->withMfs($mfs);
    }

    public function getMf(Request $request){
        $mf_id = $request->id;
        $mf = Masterfile::find($mf_id);

        $roles = Role::all();
        return view('registration.edit_mf', array(
            'mf' => $mf,
            'roles' => $roles,
            'mf_id' => $mf_id
        ));
    }

    public function updateMf(Request $request, $id){
        // validate
        $this->validate($request, array(
            'surname' => 'required',
            'firstname' => 'required',
            'registration_date' => 'required|date',
            'id_' => 'required|date',
            'gender' => 'required'
        ));


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
        // var_dump($path);exit;

        // update db record
        Masterfile::where('id', $id)
            ->update(array(
                'b_role' => $request->b_role,
                'surname' => $request->surname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'email' => $request->email,
                'gender' => $request->gender,
                'image_path' => $path,
                'id_passport' => $request->id_passport,
                'customer_type_name' => $request->customer_type_name,
                'user_role' => $request->user_role
            ));


        $request->session()->flash('success', 'Masterfile Channel has been updated');
        return redirect('edit_mf/'.$id);
    }

}
