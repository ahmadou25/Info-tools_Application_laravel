<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
{
    /**
     * Vérifiez si l'utilisateur peut voir le rendez-vous.
     */
    public function view(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id || $user->hasRole('admin');
    }

    /**
     * Vérifiez si l'utilisateur peut mettre à jour le rendez-vous.
     */
    public function update(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id || $user->hasRole('admin');
    }

    /**
     * Vérifiez si l'utilisateur peut supprimer le rendez-vous.
     */
    public function delete(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id || $user->hasRole('admin');
    }
}
