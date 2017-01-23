<?php

namespace App\Jobs;

use App\ClientWallet;
use App\CustomerBill;
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
    public function __construct(ClientWallet $client_wallet, CustomerBill $customer_bill, $phone_no)
    {
        $this->wallet = $client_wallet;
        $this->cb = $customer_bill;
        $this->phone_no = $phone_no;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // check if wallet has balance
        DB::table('client_wallet')->;
    }
}
