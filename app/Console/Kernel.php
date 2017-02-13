<?php

namespace App\Console;

use App\Jobs\GenerateCustomerBills;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
//                  ->hourly();

        //schedule for database backup
        $this->databaseBackup($schedule);


        $schedule->call(function () {
<<<<<<< HEAD
            DB::transaction(function (){
                // get all client accounts
                $accounts = ClientAccount::where('client_account_status', 1)->get();

                // get service required for billing
                $service = Service::where('service_code', 'BRCIC')->first();

                // bill them all
                if(count($accounts)){
                    foreach ($accounts as $acc){
                        if($service) {
                            // raise a bill for each account
                            $cb = new CustomerBill();
                            $cb->client_account_id = $acc->id;
                            $cb->bill_amount = $service->price;
                            $cb->bill_balance = $service->price;
                            $cb->masterfile_id = $acc->masterfile_id;
                            $cb->service_id = $service->id;
                            $cb->bill_date = date('Y-m-d'); // should change to timestamp
                            $cb->bill_due_date = date('Y-m-d'); // should change to timestamp
                            $cb->save();

                            // raise a debit journal
                            $journal = new Journal();
                            $journal->client_account_id = $acc->id;
                            $journal->particulars = $service->service_name;
                            $journal->masterfile_id = $acc->masterfile_id;
                            $journal->amount = $service->price;
                            $journal->dr_cr = 'DR';
                            $journal->customer_bill_id = $cb->id;
                            $journal->save();
                        }
                    }
                }
            });
        })->daily();
=======
            Log::info('Dipatching the job to a queue!');
            dispatch(new GenerateCustomerBills());
        })->dailyAt('16:20');
//        })->everyFiveMinutes();
>>>>>>> 6aad3868112687545718654b86dbcb853cd932cb
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

    public function databaseBackup($schedule){
        $date = Carbon::now()->toW3cString();
        $environment = env('APP_ENV');
        $schedule->command(
            "db:backup --database=mysql --destination=local --destinationPath=`date +\%Y/%d-%m-%Y`.sql --compression=gzip
"
            // "db:backup --database=mysql --destination=local --destinationPath=/{$environment}/projectname_{$environment}_{$date} --compression=sql"
        )->dailyAt('22:00');
    }
}
