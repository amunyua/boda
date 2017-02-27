<?php

namespace App\Jobs;

use App\ClientAccount;
use App\CustomerBill;
use App\Journal;
use App\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenerateCustomerBills implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('initiating customer bill queue...');

        DB::transaction(function () {
            // get all client accounts
            $accounts = ClientAccount::where([
                ['client_account_status', '=', 1],
                ['billing_start_date', '<=', date('Y-m-d')]
            ])->get();

            Log::info('Accounts: ' . $accounts);

//            // get service required for billing
            $service = Service::where('service_code', 'BRCIC')->first();
            $bill_date = date('Y-m-d H:i:s');
            $bill_due_date = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($bill_date)));

            // bill them all
            if (count($accounts)) {
                foreach ($accounts as $acc) {
                    if ($service) {
                        try {
                            Log::info('Creating Customer Bill...');
                            // creating customer bill
                            $cb = new CustomerBill();
                            $cb->client_account_id = $acc->id;
                            $cb->bill_amount = $service->price;
                            $cb->bill_balance = $service->price;
                            $cb->masterfile_id = $acc->masterfile_id;
                            $cb->service_id = $service->id;
                            $cb->bill_date = $bill_date;
                            $cb->bill_due_date = $bill_due_date;
                            $cb->save();
                            Log::info('Created Customer Bill');
                        } catch (QueryException $qe) {
                            Log::error('Failed to created Customer Bill: ' . $qe->getMessage());
                        }

                        try {
                            // raise a debit journal
                            Log::info('Creating Journal...');
                            $journal = new Journal();
                            $journal->client_account_id = $acc->id;
                            $journal->particulars = $service->service_name;
                            $journal->masterfile_id = $acc->masterfile_id;
                            $journal->amount = $service->price;
                            $journal->dr_cr = 'DR';
                            $journal->customer_bill_id = $cb->id;
                            $journal->save();
                            Log::info('Created Journal');
                        } catch (QueryException $qe) {
                            Log::error('Failed to create Journal: ' . $qe->getMessage());
                        }
                    }
                }
            } else {
                Log::warning('No Client Account found!');
            }
        });
    }
}
