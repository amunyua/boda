<?php
//
//namespace App\Jobs;
//
//use Illuminate\Bus\Queueable;
//use Illuminate\Queue\SerializesModels;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use App\ClientWallet;
//use Illuminate\Support\Facades\DB;
//
//class DepositFundsToWallet implements ShouldQueue
//{
//    use InteractsWithQueue, Queueable, SerializesModels;
//
//    protected $wallet, $amount_deposited;
//
//    /**
//     * Create a new job instance.
//     *
//     * @return void
//     */
//    public function __construct(ClientWallet $wallet, $amount_deposited)
//    {
//        $this->wallet = $wallet;
//        $this->amount_deposited = $amount_deposited;
//    }
//
//    /**
//     * Execute the job.
//     *
//     * @return void
//     */
//    public function handle()
//    {
//        DB::transaction(function(){
//            $wallet = $this->wallet;
//
//            // get wallet current balance
//            $current_balance = $wallet->wallet_balance;
//
//            // calculate new balance
//            $new_balance = $current_balance + $this->amount_deposited;
//
//            // add to float
//            $wallet->wallet_balance = $new_balance;
//            $wallet->save();
//
//            // record wallet journal credit...
//        });
//    }
//}
