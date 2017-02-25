<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecondApplicationController extends Controller
{
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
}
