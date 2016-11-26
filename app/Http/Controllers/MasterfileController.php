<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactTypes;
use App\County;
use App\Masterfile;
use App\Role;
use App\Form;
use App\Stream;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
                $this->addClient($request);
                break;
        }
        return redirect('registration');
    }

    public function addAdmin(){
        DB::transaction(function(){
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
                'mobile_no' => Input::get('phone_no'),
                'phone_no' => Input::get('tel_no'),
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
        });

        Session::flash('success', 'Administrator '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

    public function addStaff(){
        DB::transaction(function(){
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
            print_r($mf);exit;
            $mf->save();
            $mf_id = $mf->id;

            // add address details
            $address = Address::create(array(
                'county' => Input::get('county'),
                'city' => Input::get('city'),
                'masterfile_id' => $mf_id,
                'email' => Input::get('email'),
                'mobile_no' => Input::get('phone_no'),
                'phone_no' => Input::get('tel_no'),
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
        });

        Session::flash('success', 'Staff '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

    public function addClient(){
        DB::transaction(function(){
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
                'mobile_no' => Input::get('phone_no'),
                'phone_no' => Input::get('tel_no'),
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
        });

        Session::flash('success', 'Client '.$_POST['surname'].' '.$_POST['firstname'].' has been added');
    }

}
