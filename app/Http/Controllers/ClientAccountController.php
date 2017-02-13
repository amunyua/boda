<?php

namespace App\Http\Controllers;

use App\Bike;
use App\ClientAccount;
use App\ClientWallet;
use App\Masterfile;
use Illuminate\Database\QueryException as e;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class ClientAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function clientAccounts(){
        $unassigned_clients = array();
        $unassigned_bikes = array();
        $unassigned_c = array();
        $unasigned_motors = array();

        //get all clients
        $clients = DB::table('masterfiles')
            ->select('id','surname','middlename','firstname')
            ->where('status',true)
            ->where('b_role', 'Client')
            ->get();
//        print_r($assigned_customers);die;
        $assigned_customers_ = DB::table('client_accounts')
            ->select('masterfile_id')
            ->where('client_account_status',true)
            ->get();


        $assigned_motorbikes = DB::table('client_accounts')
            ->select('bike_id')
            ->where('client_account_status',true)
            ->get();
//        var_dump($assigned_customers_);die;
        if(count($assigned_customers_)){
            foreach ($assigned_customers_ as $item){
                $unassigned_c[] = $item->masterfile_id;
            }
        }

        if(count($assigned_motorbikes)){
            foreach ($assigned_motorbikes as $item){
                $unasigned_motors[] = $item->bike_id;
            }
        }
//        print_r($unassigned_c);die;
        if(count($clients)){
            foreach ($clients as $client) {
                if (!in_array($client->id, $unassigned_c)) {
                    $unassigned_clients[] = $client;
                }
            }
        }
//        print_r($unassigned_clients);die;
        //get all motorbikes
        $motorbikes = Bike::where([
            ['status',true]
        ])->get();
//        var_dump($motorbikes);
        if(count($motorbikes)){
            foreach ($motorbikes as $motorbike) {
                if (!in_array($motorbike->id, $unasigned_motors)) {
                    $unassigned_bikes[] = $motorbike;
                }
            }
        }
//        print_r($unasigned_motors);die;
        return view('client_accounts.client_accounts',array(
            'clients'=>$unassigned_clients,
            'bikes'=>$unassigned_bikes
        ));
    }

    public function createAccount(Request $request){
//        var_dump($_POST);die;
        $this->validate($request,array(
            'bike_id'=>'required',
            'masterfile_id'=>'required',
            'billing_start_date'=>'required'
        ));
        $results = $this->checkWhetherBikeAttached($request);
//        var_dump($results);die;
        if(count($results->toArray())){
            Session::flash('warning','The client is already attached to another bike');
        }else {
            $account = new ClientAccount();
            $account->bike_id = $request->bike_id;
            $account->masterfile_id = $request->masterfile_id;
            $account->created_by = $this->user()->id;
            $account->client_account_status = '1';
            $account->billing_start_date = $request->billing_start_date;
            try {
                $account->save();
            } catch (QueryException $e) {
                Session::flash('error', $e->getMessage());
            }

            // create client wallet
            try{
                $wallet = new ClientWallet();
                $wallet->client_account_id = $account->id;
                $wallet->wallet_balance = 0;
                $wallet->status = 1;
                $wallet->save();

                Session::flash('success', 'The Client Account has been created');
            } catch (QueryException $qe){
                Session::flash('error', $qe->getMessage());
            }
        }
        return redirect()->back();
    }

    public function loadAccounts(){
        $accounts = ClientAccount::all();
        return Datatables::of($accounts)
            ->editColumn('client_account_status',
                '@if($client_account_status)
                    Active
                    @else
                    Inactive
                @endif
                ')
            ->editColumn('masterfile_id',
                '
                @if(!empty($masterfile_id))
                <?php $user_name = App\Masterfile::find($masterfile_id); 
                    echo $user_name->surname." ".$user_name->firstname." ".$user_name->middlename
                ?>
                @endif
                ')
            ->editColumn('bike_id',
                '
                {{ App\Bike::find($bike_id)->vin}}
                ')
//            ->editColumn('billing_start_date',
//                "{{date('D M Y',strtotime($billing_start_date)}}"
//                )
            ->make(true);
    }

    public function destroyClientAccount(Request $request){
        $delete_ids = [$request->edit_ids];
        try{
            ClientAccount::destroy($delete_ids);
            Session::flash('success','The Client Account has been deleted');
        }catch (e $e){
            $this->handleException2($e);
        }
        return redirect()->back();
    }

    public function getEditDetails($id){
        $records = ClientAccount::find($id);
        return Response::json($records);
    }

    public function editClientAccount(Request $request){
//        print_r($this->user());die;
//        var_dump($_POST);die;
        $this->validate($request, array(
           'status'=>'required'
        ));

        $record = ClientAccount::find($request->edit_id);
        if($request->status == 1){
            $results_set = ClientAccount::where([
                ['bike_id',$record->bike_id],
                ['client_account_status',true]
            ])->get();
            $results = $results_set->toArray();
        }else{
            $results = 0;
        }
//        var_dump($results);die;
        if($results){
            Session::flash('failed','Client account details not updated, The motorbike is already active');
        }else {
            $record->client_account_status = $request->status;

            try {
                $this->recordAuditTrail();
                $record->save();
                Session::flash('success', 'The Client Account has been updated');
            } catch (e $e) {
                Session::flash('failed', 'Encountered an error');
            }
        }
        return redirect()->back();
    }

    public function checkWhetherBikeAttached($request){
        $account = ClientAccount::where([
            ['masterfile_id',$request->masterfile_id],
            ['bike_id',$request->bike_id],
            ['client_account_status',true]
        ])->get();
        return $account;
    }

    public function clientWallets(){
        return view('client_accounts.client_wallets');
    }

    public function loadClientWallets(){
        $wallets = DB::table('wallets_view');
        return Datatables::of($wallets)
            ->editColumn('wallet_balance', function ($wallet){
                return number_format(round($wallet->wallet_balance, 2), 2);
            })
            ->make(true);
    }

    public function myWallet(){
        return view('client_accounts.wallet_profile');
    }
}
