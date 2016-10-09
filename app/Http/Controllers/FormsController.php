<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class FormsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $form = Form::where('form_status', 1)->get();
        return view('form.forms', array(
            'form' => $form
        ));
    }

    public function store(Request $request){
        // validation
        $rules = array(
            'form_name' => 'required|max:255|unique:class',
            'form_code' => 'required|unique:class',
            'form_status' => 'required',
        );
        $this->validate($request, $rules);

        // add the classes record to the database
        $form = Form::create(array(
            'form_name' => Input::get('form_name'),
            'form_code' => Input::get('form_code'),
            'form_status' => Input::get('form_status')
        ));
        $form->save();

        $request->session()->flash('status', 'Class has been successfully added');
        return redirect('class');
    }

    public function update(Request $request){
        // validation
        $rules = array(
            'form_name' => Input::get('form_name'),
            'form_code' => Input::get('form_code'),
            'form_status' => Input::get('form_status')
        );

        $this->validate($request, $rules);

        // edit the details on the database
        Form::where('id', $request->id)
            ->update(array(
                'form_name' => Input::get('form_name'),
                'form_code' => Input::get('form_code'),
                'form_status' => Input::get('form_status')
            ));
    }

    public function delete(Request $request){
        $data = Form::destroy($request->id);
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
}
