<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class CustomerBillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        return view('bills_and_payments.bills');
    }

    public function loadBills(){
        $bills = DB::table('bill_data');
        return Datatables::of($bills)
            ->editColumn('bill_status', function($bill){
                if(!$bill->bill_status)
                    return '<span class="label label-warning">Pending</span>';
                else
                    return '<span class="label label-success">Paid</span>';
            })
            ->make(true);
    }
}
