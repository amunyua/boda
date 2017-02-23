<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    private $month, $year, $months = [];

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('validateroutes');
        $this->middleware('checkiffap');

        $this->month = date('m');
        $this->year = date('Y');
        $this->months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
    }

    public function index(){
        return view('home.index');
    }

    public function dailyCollection(){
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        // get the cash collected for each day in the month
        $collections = [];
        for($i = 1; $i <= $days_in_month; $i++){
            $transaction_date = date($this->year.'-'.$this->month.'-'.$i);

            $days_collection = Transaction::where('transaction_date', $transaction_date)->sum('cash_paid');
            $collections[] = [$i,$days_collection];
        }

        return Response::json([
            'collections' => $collections
        ]);
    }

    public function weeklyCollection(){
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $no_of_weeks = (ceil(intval($days_in_month)/7));

        $collections = [];
        $week_inc = 0;

        // get the cash collected for each week in the month
        for($i = 1; $i <= $no_of_weeks; $i++){
            if($week_inc + 7 > $days_in_month)
                $day = $days_in_month;
            else
                $day = $week_inc + 7;

            $from_date = date($this->year."-".$this->month."-".($week_inc+1));
            $to_date = date($this->year."-".$this->month."-".($day));

            $week_collection = Transaction::whereBetween('transaction_date', [$from_date, $to_date])->sum('cash_paid');
            $collections[] = [$i, $week_collection];
            $week_inc += 7;
        }

        return Response::json([
            'collections' => $collections
        ]);
    }

    public function monthlyCollection(){
        $collections = [];

        // get the cash collected for each month in the year
        for ($month = 1; $month <= 12; $month++){
            $month_name = $this->months[$month];

            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $this->year);

            $from_date = date($this->year."-".$this->month."-01");
            $to_date = date($this->year."-".$this->month."-".$days_in_month);

            $month_collection = Transaction::whereBetween('transaction_date', [$from_date, $to_date])->sum('cash_paid');
            $collections[] = [$month, $month_collection];
        }

        return Response::json([
            'collections' => $collections
        ]);
    }
}
