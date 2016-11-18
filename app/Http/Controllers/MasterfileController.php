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
            'role' => 'required',
            'id_no' => 'required',
            'firstname' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'regdate' => 'required'
        );
        $this->validate($request, $rules);

        DB::transaction(function(){
            $role = Role::where('role_code', Input::get('role_code'))->first();

            // create registration
            $reg = Masterfile::create(array(
                'surname' => Input::get('surname'),
                'first_name' => Input::get('firstname'),
                'middle_name' => Input::get('middlename'),
                'regdate' => Input::get('regdate'),
                'gender' => Input::get('gender'),
                'id_no' => Input::get('id_no'),
                'b_role' => 'Staff',
                'user_role' => 1
            ));
            $reg->save();
            $reg_id = $reg->id;

            // create contact
            $contact = Contact::create(array(
                'postal_address' => Input::get('postal_address'),
                'physical_address' => Input::get('physical_address'),
                'masterfile_id' => $reg_id,
                'telephone_no' => Input::get('tel_no'),
                'email' => Input::get('email'),
                'mobile_no' => Input::get('mobile_no')
            ));
            $contact->save();

            // create user login account
            $password = sha1(123456);
            $login = User::create(array (
                'masterfile_id' => $reg_id,
                'email' => Input::get('email'),
                'phone_no' => Input::get('phone_no'),
                'password' => $password
            ));
            var_dump($login);exit;
            $login->save();
        });
    }

    public function client(Request $request){
        $rules = array(
            'role' => 'required',
            'id_no' => 'required',
            'firstname' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'regdate' => 'required'
        );
        $this->validate($request, $rules);

        DB::transaction(function(){
            $role = Role::where('role_code', Input::get('role_code'))->first();

            // create registration
            $reg = Masterfile::create(array(
                'surname' => Input::get('surname'),
                'first_name' => Input::get('firstname'),
                'middle_name' => Input::get('middlename'),
                'regdate' => Input::get('regdate'),
                'gender' => Input::get('gender'),
                'id_no' => Input::get('id_no'),
                'b_role' => 'Client',
                'user_role' => 1
            ));
            $reg->save();
            $reg_id = $reg->id;

            // create contact
            $contact = Contact::create(array(
                'postal_address' => Input::get('postal_address'),
                'physical_address' => Input::get('physical_address'),
                'masterfile_id' => $reg_id,
                'telephone_no' => Input::get('tel_no'),
                'email' => Input::get('email'),
                'mobile_no' => Input::get('mobile_no')
            ));
            $contact->save();

            // create user login account
            $password = sha1(123456);
            $login = User::create(array (
                'masterfile_id' => $reg_id,
                'email' => Input::get('email'),
                'phone_no' => Input::get('phone_no'),
                'password' => $password
            ));
            var_dump($login);exit;
            $login->save();
        });
    }
}
