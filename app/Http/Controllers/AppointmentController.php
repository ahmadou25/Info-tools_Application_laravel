<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\User;

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
    
        // Initialisez la requête de base pour les rendez-vous
        $query = $user->hasRole('Manager')
            ? Appointment::with('client') // Managers voient tous les rendez-vous
            : Appointment::where('user_id', $user->id)->with('client'); // Commercials voient leurs propres rendez-vous
    
        // Appliquez le filtre si un `id` (client) est fourni
        if ($request->filled('client_id')) {
            // Remplacez client_id par id, en supposant que client_id soit un champ dans le modèle Appointment
            $query->whereHas('client', function($q) use ($request) {
                $q->where('id', $request->client_id);
            });
        }

            // Filtre par statut
            if(request('status')) {
                $query->where('status', request('status'));
            }
    
        // Exécutez la requête
        $appointments = $query->get();
    
        // Récupérez tous les clients pour le filtrage
        $clients = Client::all();
    
        // Retournez la vue avec les données des rendez-vous et des clients
        return view('appointments.index', compact('appointments', 'clients'));
    }
    
    

    /**
     * Affiche le formulaire de création d'un nouveau rendez-vous.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = auth()->user();
    
        // Si l'utilisateur est un manager, charger les commerciaux
        $commercials = $user->role === 'Manager'
            ? User::where('role', 'Salesperson')->get()
            : null;
    
        $clients = Client::all();
    
        return view('appointments.create', compact('clients', 'commercials'));
    }
    
    /**
     * Enregistre un nouveau rendez-vous dans la base de données.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        // Déterminer si l'utilisateur est un commercial ou un manager
        $validatedData = $request->validate([
            'id' => 'required|exists:clients,id',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
           /// 'status' => 'required|string|in:Planned,Completed,Cancelled',
            // Si c'est un Manager, on attend un commercial_id, sinon on utilise l'user_id
            'user_id' => $user->hasRole('Manager') 
                ? 'nullable' // Ne pas valider le user_id si c'est un manager
                : 'required|exists:users,id', // Le commercial doit toujours avoir un user_id

            // Si c'est un Manager, on demande un commercial_id
            'commercial_id' => $user->hasRole('Manager') 
                ? 'required|exists:users,id' 
                : 'nullable', // Pas nécessaire pour un commercial
        ]);

        // Si l'utilisateur est un manager, on utilise commercial_id, sinon on utilise user_id
        $userId = $user->hasRole('Manager') ? $request->commercial_id : $user->id;

        // Création du rendez-vous
        Appointment::create([
            'id' => $validatedData['id'],
            'date_time' => $validatedData['date_time'],
            'location' => $validatedData['location'],
           // 'status' => $validatedData['status'],
            'user_id' => $userId,  // On utilise user_id ou commercial_id selon le cas
        ]);

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
        $user = auth()->user();

        // Autorisez si l'utilisateur est le créateur du rendez-vous ou un manager
        if ($user->id !== $appointment->user_id && !$user->hasRole('Manager')) {
            abort(403, 'Vous n\'êtes pas autorisé à voir ce rendez-vous.');
        }

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
        $user = auth()->user();

        // Autorisez si l'utilisateur est le créateur du rendez-vous ou un manager
        if ($user->id !== $appointment->user_id && !$user->hasRole('Manager')) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier ce rendez-vous.');
        }

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
        $user = auth()->user();

        // Autorisez si l'utilisateur est le créateur du rendez-vous ou un manager
        if ($user->id !== $appointment->user_id && !$user->hasRole('Manager')) {
            abort(403, 'Vous n\'êtes pas autorisé à mettre à jour ce rendez-vous.');
        }

        $validatedData = $request->validate([
            'id' => 'required|exists:clients,id', // Correction pour la clé primaire
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
        $user = auth()->user();

        // Autorisez si l'utilisateur est le créateur du rendez-vous ou un manager
        if (!$user->hasRole('Manager')) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer ce rendez-vous.');
        }

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous supprimé avec succès.');
    }

    public function cancel(Appointment $appointment)
    {
        // Change le statut à "Canceled"
        $appointment->status = 'Canceled';
        $appointment->save();

        // Redirige avec un message de succès
        return redirect()->route('appointments.index')->with('success', 'Le rendez-vous a été annulé avec succès.');
    }
}