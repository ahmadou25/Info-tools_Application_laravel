<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Appointment;
use Carbon\Carbon;

class CheckAppointments
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Met à jour les rendez-vous passés
        Appointment::where('date_time', '<', Carbon::now())
                 ->where('status', 'Planned')
                 ->update(['status' => 'Realized']);
        
        return $next($request);
    }
}