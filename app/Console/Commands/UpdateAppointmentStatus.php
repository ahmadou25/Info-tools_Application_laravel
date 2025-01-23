<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Carbon\Carbon;

class UpdateAppointmentStatus extends Command
{
    /**
     * Le nom et la signature de la commande.
     *
     * @var string
     */
    protected $signature = 'UpdateAppointmentStatus';

    /**
     * La description de la commande.
     *
     * @var string
     */
    protected $description = 'Met à jour le statut des rendez-vous à "Realized" si la date est passée.';

    /**
     * Exécute la commande.
     *
     * @return int
     */
    public function handle()
    {
        // Logique pour mettre à jour les rendez-vous
        $this->info('Mise à jour des statuts des rendez-vous...');
        
        $now = Carbon::now();

        $updated = Appointment::where('status', 'Planned')
            ->where('date_time', '<', $now)
            ->update(['status' => 'Realized']);

        $this->info("{$updated} rendez-vous mis à jour.");

        return 0; // Succès
    }
}
