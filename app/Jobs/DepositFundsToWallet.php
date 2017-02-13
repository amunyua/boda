<?php

namespace App\Jobs;

use App\Journal;
use App\Masterfile;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\ClientWallet;
use Illuminate\Support\Facades\DB;

class DepositFundsToWallet implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $wallet, $amount_deposited, $phone_no;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ClientWallet $wallet, Journal $journal, $amount_deposited, $phone_no)
    {
        $this->wallet = $wallet;
        $this->journal = $journal;
        $this->amount_deposited = $amount_deposited;
        $this->phone_no = $phone_no;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::transaction(function(){
            $wallet = $this->wallet;

            // get client data
            $mf = Masterfile::where('phone_no', $this->phone_no)->first();
            $cw_data = DB::table('wallet_view')->where('masterfile_id', $mf->id)->first();

            // get wallet current balance
            $current_balance = $wallet->wallet_balance;

            // calculate new balance
            $new_balance = $current_balance + $this->amount_deposited;

            // add to float/balance
            $wallet->wallet_balance = $new_balance;
            $wallet->save();

            // credit the wallet journal
            $wj = $this->journal;
            $wj->client_account_id = $cw_data->client_account_id;
            $wj->client_wallet_id = $cw_data->id;
            $wj->particulars = 'Deposited '.$this->amount_deposited;
            $wj->masterfile_id = $cw_data->masterfile_id;
            $wj->amount = $this->amount_deposited;
            $wj->dr_cr = 'CR';
            $wj->save();
        });
    }
}
