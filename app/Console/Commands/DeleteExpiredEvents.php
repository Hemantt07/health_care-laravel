<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Events;
use App\Models\Appointments;
use Carbon\Carbon;

class DeleteExpiredEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete-expired-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete events that are 2 days older than current day';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDate = Carbon::now();
        $expiredAppointments = Appointments::where('date', '<', $currentDate->subDays(2))->get();
        foreach ($expiredAppointments as $appointment) {
            $event =  Events::where('appointmentId', $appointment_id)->first();
            $event->delete();
            $appointment->delete();
            $this->info("Deleted event with ID: {$event->id}");
        }

        $this->info('Expired events have been deleted successfully.');
        return Command::SUCCESS;
    }
}
