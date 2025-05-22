<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Carbon\Carbon;

class UpdateAppointmentsStatus extends Command
{
    protected $signature = 'appointments:update';
    protected $description = 'Update status of past appointments to Realized';

    public function handle()
    {
        $count = Appointment::where('date_time', '<', Carbon::now())
                          ->where('status', 'Planned')
                          ->update(['status' => 'Realized']);
        
        $this->info("$count appointment(s) updated to Realized status.");
        return 0;
    }
}