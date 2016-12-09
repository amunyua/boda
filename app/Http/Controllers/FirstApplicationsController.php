<?php

namespace App\Http\Controllers;

use App\FirstApplication;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class FirstApplicationsController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'unique:first_applications',
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
                $fa = new FirstApplication();
                $fa->surname = $request->surname;
                $fa->firstname = $request->firstname;
                $fa->middlename = $request->middlename;
                $fa->phone_no = $request->phone_no;
                $fa->gender = $request->gender;
                $fa->email = $request->email;
                $fa->save();

                if(!empty($request->email)){
                    // save email

                    // send an email with info tracking application progress
                }

                // save sms notification

                // send an welcome sms with info for tracking application progress

                $return = [
                    'success' => true,
                    'message' => 'Your first application has been sent. We will get back to you ASAP!',
                    'type' => 'success'
                ];
            } catch (QueryException $qe){
                $return = array(
                    'success' => 'false',
                    'message' => $qe->getMessage(),
                    'type' => 'error'
                );
            }
        }

        return Response::json($return);
    }
}
