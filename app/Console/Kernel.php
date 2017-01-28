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
            Log::info('Dipatching the job to a queue!');
            dispatch(new GenerateCustomerBills());
        })->dailyAt('16:20');
//        })->everyFiveMinutes();
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
