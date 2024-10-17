<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Affiche une liste des rendez-vous de l'utilisateur connecté.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = auth()->user(); // Obtenez l'utilisateur connecté

        // Si l'utilisateur est admin, récupérez tous les rendez-vous, sinon récupérez ceux de l'utilisateur
        $appointments = $user->hasRole('admin')
            ? Appointment::with('client')->get() // Récupérez tous les rendez-vous pour les admins
            : Appointment::where('user_id', $user->id)->with('client')->get(); // Récupérez uniquement les rendez-vous de l'utilisateur

        // Récupérez tous les clients pour le filtrage
        $clients = Client::all();

        return view('appointments.index', compact('appointments', 'clients'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau rendez-vous.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $clients = Client::all(); // Récupérez tous les clients pour le formulaire
        return view('appointments.create', compact('clients'));
    }

    /**
     * Enregistre un nouveau rendez-vous dans la base de données.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        // Ajoutez l'ID de l'utilisateur connecté
        $validatedData['user_id'] = auth()->id();

        Appointment::create($validatedData);

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous créé avec succès.');
    }

    /**
     * Affiche les détails d'un rendez-vous spécifique.
     *
     * @param Appointment $appointment
     * @return \Illuminate\View\View
     */
    public function show(Appointment $appointment)
    {
        // Vérifiez que l'utilisateur est soit le créateur du rendez-vous, soit un admin
        $this->authorize('view', $appointment);
        $user = auth()->user(); // Obtenez l'utilisateur connecté

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Affiche le formulaire d'édition d'un rendez-vous.
     *
     * @param Appointment $appointment
     * @return \Illuminate\View\View
     */
    public function edit(Appointment $appointment)
    {
        // Vérifiez que l'utilisateur est soit le créateur du rendez-vous, soit un admin
        $this->authorize('update', $appointment);

        $clients = Client::all(); // Récupérez tous les clients pour le formulaire
        return view('appointments.edit', compact('appointment', 'clients'));
    }

    /**
     * Met à jour un rendez-vous dans la base de données.
     *
     * @param Request $request
     * @param Appointment $appointment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Vérifiez que l'utilisateur est soit le créateur du rendez-vous, soit un admin
        $this->authorize('update', $appointment);

        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        // Mettez à jour le rendez-vous
        $appointment->update($validatedData);

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    /**
     * Supprime un rendez-vous de la base de données.
     *
     * @param Appointment $appointment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Appointment $appointment)
    {
        // Vérifiez que l'utilisateur est soit le créateur du rendez-vous, soit un admin
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous supprimé avec succès.');
    }
}
