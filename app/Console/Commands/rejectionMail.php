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
        $validatedUsers = $appointments->filter( function(Appointments $appointments){
            return( $appointments->status == 'Cancelled' );
        } );

        foreach ($validatedUsers as $key => $value) {
            echo( $value->user );
            Mail::to($user->email)->send(new RejectionMail( $data ));
        }
    }
}
