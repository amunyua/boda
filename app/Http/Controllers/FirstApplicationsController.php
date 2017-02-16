<?php

namespace App\Http\Controllers;

use App\FirstApplication;
use App\Role;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class FirstApplicationsController extends Controller
{
    const client_role = 'CLIENT';

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:first_applications',
            'phone_no' => 'required|unique:first_applications',
            'gender' => 'required'
        ]);

        $return = [];
        if($validator->fails()){
            $return = array(
                'success' => false,
                'warnings' => $validator->getMessageBag()->toArray(),
                'type' => 'warnings'
            );
        }else{
            try{
                $area_code = 254;
                $ph_no = ltrim($request->phone_no, 0);
                $phone_no = $area_code.$ph_no;

                // create application and add it to the waiting list for approval
                $fa = new FirstApplication();
                $fa->surname = $request->surname;
                $fa->firstname = $request->firstname;
                $fa->middlename = $request->middlename;
                $fa->phone_no = $phone_no;
                $fa->gender = $request->gender;
                $fa->email = $request->email;
                $fa->save();

                // create rider's login account for the candidate to track and complete the appliation
                $user = new User();
                $user->name = $request->surname.' '.$request->firstname;
                $user->email = $request->email;
                $user->password = bcrypt(123456);
                $user->status = 1;
                $user->phone_no = $phone_no;
                $user->save();
                $client_role = Role::where('role_code', self::client_role)->first();
                $user->roles()->attach($client_role);

                if(!empty($request->email)){
                    // send confirmation email
                    
                }

                // send an welcome sms with info for tracking application progress

                $return = [
                    'success' => true,
                    'message' => 'Your first application has been sent. We will get back to you ASAP!',
                    'type' => 'success'
                ];
            } catch (QueryException $qe){
                $return = array(
                    'success' => false,
//                    'message' => $qe->getMessage(),
                    'message' => 'Phone number already exists! Please use a different phone no!',
                    'type' => 'error'
                );
            }
        }

        return Response::json($return);
    }
}
