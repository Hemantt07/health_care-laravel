<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class rejectionMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:to';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is to send mail to the client whose appointment has ben cancelled';

    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $appointments = Appointments::all();
        $validatedAppointments = $appointments->where( $appointments->status === 'Cancelled' );

        foreach ($validatedAppointments as $key => $value) {
            foreach ($appointments as $appointment) {
                Mail::to($appointment->email)->queue(new RejectionMail($data));
            }
        
            $this->info('Rejection emails sent successfully.');
        }
    }
}
