<?php

namespace App\Console;


use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 */
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
        // $schedule->command('activitylog:clean')->daily();

//*********************Send mails 30 minutes before end time***************************************
        $schedule->call(function () {
        
            $bookings = Reservation::where('start_date','<',Carbon::now())
            ->where('end_date','>',Carbon::now())
            ->where('end_date','<',Carbon::now()->addMinutes(30))
            ->get();

            foreach($bookings as $booking){
                try{
                    $enums = explode(',',$booking->E_numbers);

                    foreach ($enums as $enum){

                        //get enumber
                        $enum1=explode('/',$enum);
                        $batch=$enum1[1];
                        $regnum=$enum1[2];

                        //set api url
                        $apiurl = 'https://api.ce.pdn.ac.lk/people/v1/students/E'.''.$batch.'/'.$regnum.'/';

                        //api call
                        $response = Http::withoutVerifying()
                        ->get($apiurl);

                        //extract email address
                        $email=($response['emails']['faculty']['name'].'@'.$response['emails']['faculty']['domain']);

                        //get user
                        $user = auth()->user();

                        //send mail
                        Mail::to($email)
                            ->send(new StationReservationMail(auth()->user(), $station, $booking));
                    }

                }catch(\Exception $e){
                }
            }
        })->hourly();

//************************************************************************* */
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
