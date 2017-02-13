<?php

namespace App\Http\Controllers;

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
    }
}
