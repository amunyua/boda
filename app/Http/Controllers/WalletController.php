<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use App\ClientWallet;

class WalletController extends Controller
{
    public function creditWallet(Request $request){
        try{
            $client_wallet = new ClientWallet();
            $client_wallet->wallet_balance = 50;
            $client_wallet->client_account_id = $request->client_account_id;
            $client_wallet->save();

            // fire event

        } catch (QueryException $qe){

        }
=======
use App\Jobs\ClearBillsWithBalance;
use App\SystemConfig;
use App\WalletJournal;
use GuzzleHttp\Client;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\ClientWallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Jobs\TestQueues;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public function depositToWallet(Request $request){
        // validate
        $validator = Validator::make($request->all(), [
            'deposit_amount' => 'required|numeric|min:10'
        ]);

        $return = [];
        if($validator->fails()){
            $return = [
                'success' => false,
                'warnings' => $validator->getMessageBag()->toArray(),
                'type' => 'warning'
            ];
        } else {
            $deposit_amount = $request->deposit_amount;
            $user = Auth::user();
            $cw_data = DB::table('wallet_view')->where('masterfile_id', $user->masterfile_id)->first();

            // get company paybill no
//            $paybill_no = SystemConfig::find(1)->paybill_no;
//            $response = mpesa($deposit_amount, $user->phone_no)->usingReferenceId($paybill_no)->transact();
//            dd($response);

            // get current client's wallet balance
            $current_balance = DB::table('wallet_view')
                ->where('masterfile_id', $user->masterfile_id)
                ->first()
                ->wallet_balance;
            $new_balance = $current_balance + $deposit_amount;

            // deposit the funds to client Wallets
            try{
                Log::info('Trying to update wallet balance...');
                ClientWallet::where('client_account_id', $cw_data->client_account_id)
                    ->update([
                        'wallet_balance' => $new_balance
                    ]);
                Log::info('Client wallet has been successfully updated!');
            } catch (QueryException $qe) {
                Log::error('Failed to update wallet balance!'.$qe->getMessage());
                $return = [
                    'success' => false,
                    'response' => $qe->getMessage(),
                    'type' => 'error'
                ];
            }

            try{
                // credit the wallet journal
                $wj = new WalletJournal();
                $wj->client_account_id = $cw_data->client_account_id;
                $wj->client_wallet_id = $cw_data->id;
                $wj->particulars = 'Deposited '.$deposit_amount;
                $wj->masterfile_id = $cw_data->masterfile_id;
                $wj->amount = $deposit_amount;
                $wj->dr_cr = 'CR';
                $wj->save();

                $return = [
                    'success' => true,
                    'response' => 'sldfjlds',
                    'type' => 'success'
                ];
            } catch (QueryException $qe) {
                $return = [
                    'success' => false,
                    'response' => $qe->getMessage(),
                    'type' => 'error'
                ];
            }
        }

        // initiate clearing of any pending bills attached to the user
        $this->dispatch(new ClearBillsWithBalance($user->phone_no));

        return Response::json($return);
>>>>>>> 6aad3868112687545718654b86dbcb853cd932cb
    }
}
