<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ApiAppointmentController extends Controller
{
    /**
     * Affiche une liste de tous les rendez-vous.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupère tous les rendez-vous avec leurs clients associés
       // $appointments = Appointment::with('client')->get();
       $user = auth()->user(); // Obtenez l'utilisateur connecté

       // Si l'utilisateur est un manager, récupérez tous les rendez-vous, sinon récupérez ceux de l'utilisateur
       $appointments = $user->hasRole('Manager')
           ? Appointment::with('client')->get() // Récupère tous les rendez-vous pour les managers
           : Appointment::where('user_id', $user->id)->with('client')->get(); // Récupère uniquement les rendez-vous de l'utilisateur pour les commerciaux

       // Récupérez tous les clients pour le filtrage
       $clients = Client::all();

        // Retourne la réponse JSON avec la liste des rendez-vous
        return response()->json([
            "success" => true,
            "message" => "Liste des rendez-vous",
            "data" => $appointments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user(); // Utilisateur connecté

            // Validation des données
            $validatedData = $request->validate([
                'id' => 'required|exists:clients,id',
                'date_time' => 'required|date',
                'location' => 'required|string|max:255',
                'status' => 'required|string|in:Planned,Completed,Cancelled',
                // Le champ 'user_id' est maintenant obligatoire et rempli par l'ID de l'utilisateur connecté
                'user_id' => 'required|exists:users,id', // Ce champ est obligatoire et doit exister dans la table 'users'
            ]);

            // Toujours assigner le 'user_id' (commercial_id) avec l'ID de l'utilisateur connecté
            $userId = $user->id; // On prend l'ID de l'utilisateur connecté

            // Création du rendez-vous
            $appointment = Appointment::create([
                'id' => $validatedData['id'],
                'date_time' => $validatedData['date_time'],
                'location' => $validatedData['location'],
                'status' => $validatedData['status'],
                'user_id' => $userId, // Le 'user_id' est l'ID du commercial connecté
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Rendez-vous créé avec succès',
                'data' => $appointment,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du rendez-vous: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Affiche les détails d'un rendez-vous spécifique.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        // Retourne les informations d'un rendez-vous spécifique avec son client
        return response()->json([
            "success" => true,
            "message" => "Rendez-vous trouvé",
            "data" => $appointment
        ]);
    }

    /**
     * Met à jour un rendez-vous existant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Validation des données de la requête
        $request->validate([
            'id' => 'required|exists:clients,id',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:Planned,Completed,Cancelled',
        ]);
    
        // Vérifier si l'utilisateur a le droit de modifier ce rendez-vous
        $user = auth()->user();
        if ($appointment->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'êtes pas autorisé à modifier ce rendez-vous.',
            ], 403);
        }
    
        // Mise à jour du rendez-vous
        $appointment->update([
            'id' => $request->id,
            'date_time' => $request->date_time,
            'location' => $request->location,
            'status' => $request->status,
        ]);
    
        // Retourne la réponse JSON avec le rendez-vous mis à jour
        return response()->json([
            "success" => true,
            "message" => "Rendez-vous mis à jour avec succès",
            "data" => $appointment
        ]);
    }

    /**
     * Supprime un rendez-vous spécifique.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        // Vérifier si l'utilisateur a le droit de supprimer ce rendez-vous
        $user = auth()->user();
        if ($appointment->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'êtes pas autorisé à supprimer ce rendez-vous.',
            ], 403);
        }
        
        // Récupérer l'ID du rendez-vous avant suppression
        $appointmentId = $appointment->id;
        
        // Suppression du rendez-vous
        $appointment->delete();
        
        // Retourner l'ID du rendez-vous supprimé dans la réponse
        return response()->json([
            "success" => true,
            "message" => "Rendez-vous supprimé avec succès",
            "data" => ['appointment_id' => $appointmentId]
        ]);
    }
    
}
