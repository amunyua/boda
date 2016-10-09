<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactType;
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
    const student = 'STUDENT';
    const teacher = 'TEACHER';
    const guardian = 'GUARDIAN';
    const ss = 'SS';

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $roles = Role::all();
        $main_ctype = ContactType::where('contact_type_code', 'MAIN')->first();
        $forms = Form::where('class_status', 1)->get();
        $streams = Stream::where('stream_status', 1)->get();

        return view('masterfile.index', array(
            'roles' => $roles,
            'main_ctype' => $main_ctype,
            'forms' => $forms,
            'streams' => $streams
        ));
    }

    public function store(Request $request){
        $rules = array(
            'role' => 'required',
            'id_no' => 'required',
            'fname' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'dob' => ($request->role == self::student) ? 'required' : '',
            'physical_address' => 'required'
        );
        $this->validate($request, $rules);

        DB::transaction(function(){
            $role = Role::where('role_code', Input::get('role_code'))->first();

            // create masterfile
            $mf = Masterfile::create(array(
                'surname' => Input::get('surname'),
                'first_name' => Input::get('fname'),
                'middle_name' => Input::get('mname'),
                'dob' => Input::get('dob'),
                'gender' => Input::get('gender'),
                'id_no' => Input::get('id_no'),
                'role_id' => 1
            ));
            $mf->save();
            $mf_id = $mf->id;

            // create contact
            $contact = Contact::create(array(
                'postal_address' => Input::get('postal_address'),
                'physical_address' => Input::get('physical_address'),
                'masterfile_id' => $mf_id,
                'telephone_no' => Input::get('tel_no'),
                'email' => Input::get('email'),
                'mobile_no' => Input::get('mobile_no')
            ));
            $contact->save();

            switch (Input::get('role')){
                case self::student:
                    // create student file

                    break;

                case self::guardian:
                    // create guardian file

                    break;

                case self::teacher:
                    // create teacher file

                    break;

                case self::ss:
                    // create subordinate staff file

                    break;
            }
        });
    }
}
