<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    private $month, $year;

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('validateroutes');
        $this->middleware('checkiffap');

        $this->month = date('m');
        $this->year = date('Y');
    }

    public function setMonth($month){
        $this->month = $month;
    }

    public function getMonth(){
        return $this->month;
    }

    public function setYear($year){
        $this->year = $year;
    }

    public function getYear(){
        return $this->year;
    }

    public function index(){
        return view('home.index');
    }

    public function dailyCollection(){
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $this->getMonth(), $this->getYear());

        // get the cash collected for each day in the month
        $collections = [];
        for($i = 1; $i <= $days_in_month; $i++){
            $transaction_date = date($this->year.'-'.$this->month.'-'.$i);

            $days_collection = Transaction::where('created_at', $transaction_date)->sum('cash_paid');
            $collections[] = [$i,$days_collection];
        }

        return Response::json([
            'collections' => $collections
        ]);
    }

    public function weeklyCollection(){
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $this->getMonth(), $this->getYear());

        $collections = [];
    }

    public function getWeeksInMonth(){
        
    }
}
