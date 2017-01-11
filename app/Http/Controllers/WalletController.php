<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use App\ClientWallet;
use Illuminate\Support\Facades\Log;
use App\Jobs\TestQueues;

class WalletController extends Controller
{
    public function creditWallet(Request $request){
        Log::info('Crediting Wallet!');
        // dispatch the job
        dispatch(new TestQueues());

//        try{
//            $client_wallet = new ClientWallet();
//            $client_wallet->wallet_balance = 50;
//            $client_wallet->client_account_id = $request->client_account_id;
//            $client_wallet->save();
//
//            // dispatch job to deposit the deposited amount to the client's Wallet
//
//        } catch (QueryException $qe) {
//            Log::info('Credit Wallet Fail: '. $qe->getMessage());
//        }
    }
}
