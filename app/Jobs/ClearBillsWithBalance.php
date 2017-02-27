<?php

namespace App\Jobs;

use App\ClientWallet;
use App\CustomerBill;
use App\Transaction;
use App\WalletJournal;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class ClearBillsWithBalance implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $wallet, $cb, $phone_no;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone_no)
    {
        $this->phone_no = $phone_no;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // check if wallet has balance and get it
        $wallet = DB::table('wallet_view')->where('phone_no', $this->phone_no)->first();
        $wallet_balance = $wallet->wallet_balance;

        if($wallet_balance > 0){

            // get all bills with balances
            $pending_bills = CustomerBill::where('bill_balance', '>', 0)->get();

            if(count($pending_bills)){
                foreach ($pending_bills as $pending_bill) {

                    if($pending_bill->bill_balance > $wallet_balance){
                        $new_bill_balance = $pending_bill->bill_balance - $wallet_balance;

                        // reduce the bill balance
                        CustomerBill::where('client_account_id', $wallet->client_account_id)
                            ->update([
                                'wallet_balance' => $new_bill_balance
                            ]);

                        // clear the wallet balance
                        $wallet_balance = 0;

                        // debit wallet journal
                        $wj = new WalletJournal();
                        $wj->client_account_id = $wallet->client_account_id;
                        $wj->client_wallet_id = $wallet->id;
                        $wj->particulars = 'Payment of Pending Bill#: '.$pending_bill->id.' Amount: '.$wallet_balance;
                        $wj->masterfile_id = $wallet->masterfile_id;
                        $wj->amount = $wallet_balance;
                        $wj->dr_cr = 'DR';
                        $wj->save();

                        // record transaction
                        $transaction = new Transaction();
                        $transaction->client_account_id = $wallet->client_account_id;
                        $transaction->masterfile_id = $wallet->masterfile_id;
                        $transaction->cash_paid = $wallet_balance;
                        $transaction->service_id = $pending_bill->service_id;
                        $transaction->reversed = 0;
                        $transaction->description = "Payment of pending bill";
                        $transaction->customer_bill_id = $pending_bill->id;
                        $transaction->date = date('Y-m-d');
                        $transaction->save();
                    } else {

                        // clear the bill balance
                        CustomerBill::where('client_acount_id', $wallet->client_account_id)
                            ->update([
                                'bill_balance' => 0
                            ]);

                        // reduce the wallet balance
                        $wallet_balance -= $pending_bill->bill_balance;

                        // debit wallet journal
                        $wj = new WalletJournal();
                        $wj->client_account_id = $wallet->client_account_id;
                        $wj->client_wallet_id = $wallet->id;
                        $wj->particulars = 'Payment of Pending Bill#: '.$pending_bill->id.' Amount: '.$wallet_balance;
                        $wj->masterfile_id = $wallet->masterfile_id;
                        $wj->amount = $pending_bill->bill_balance;
                        $wj->dr_cr = 'DR';
                        $wj->save();

                        // record the transaction
                        $transaction = new Transaction();
                        $transaction->client_account_id = $wallet->client_account_id;
                        $transaction->masterfile_id = $wallet->masterfile_id;
                        $transaction->cash_paid = $pending_bill->bill_balance;
                        $transaction->service_id = $pending_bill->service_id;
                        $transaction->reversed = 0;
                        $transaction->description = "Payment of pending bill";
                        $transaction->customer_bill_id = $pending_bill->id;
                        $transaction->save();
                    }
                }

                // update the wallet balance
                ClientWallet::where('client_account_id', $wallet->client_account_id)
                    ->update([
                        'wallet_balance' => $wallet_balance
                    ]);
            }
        }
    }
}
