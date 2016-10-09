<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $subjects = Subject::where('subject_status', 1)->get();
        return view('academics.subjects', array(
            'subjects' => $subjects
        ));
    }
    
    public function store(Request $request){
        // validation
        $rules = array(
            'subject_name' => 'required|max:255|unique:subjects',
           'subject_code' => 'required|unique:subjects',
            'subject_mandatory' => 'required',
        );
        $this->validate($request, $rules);

        $mandatory = Input::get('subject_mandatory');
        $mandatory = ($mandatory == 'on') ? 1 : 0;
        // add the subject record to the database
        $subject = Subject::create(array(
            'subject_name' => Input::get('subject_name'),
            'subject_code' => Input::get('subject_code'),
            'mandatory' => $mandatory   
        ));
        $subject->save();
        
        $request->session()->flash('status', 'Subject has been successfully added');
        return redirect('subject');
    }
    
    public function update(Request $request){
        // validation
        $rules = array(
            'subject_name' => Input::get('subject_name'),
            'subject_code' => Input::get('subject_code'),
            'subject_status' => Input::get('subject_status'),
            'subject_mandatory' => Input::get('subject_mandatory')
        );

        $this->validate($request, $rules);

        // edit the details on the database
        Subject::where('id', $request->id)
            ->update(array(
                'subject_name' => Input::get('subject_name'),
                'subject_name' => Input::get('subject_name'),
                'subject_code' => Input::get('subject_code'),
                'subject_status' => Input::get('subject_status'),
                'subject_mandatory' => Input::get('subject_mandatory')
            ));
    }
    
    public function delete(Request $request){
        $data = Subject::destroy($request->id);
        if($data){
            $return = array(
                'success' => true
            );
        }else{
            $return = array(
                'success' => false
            );
        }
        return Response::json($return);
    }

    public function getSubjectData(Request $request){
        $subject_id = $request->subject_id;
        $subject = Subject::find($subject_id);

        return Response::json($subject);
    }
}
