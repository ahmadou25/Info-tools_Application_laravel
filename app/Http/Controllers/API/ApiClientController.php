<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ApiClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupère tous les clients
        $clients = Client::all();

        // Retourne la réponse JSON avec la structure souhaitée
        return response()->json([
            "success" => true,
            "message" => "Liste des clients",
            "data" => $clients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|digits:10',
            'address' => 'required|string',
            'type' => 'required',
        ]);

        // Création du client
        $client = Client::create($request->all());

        // Retourne la réponse JSON avec le client ajouté
        return response()->json([
            "success" => true,
            "message" => "Client créé avec succès",
            "data" => $client
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        // Retourne les informations d'un client spécifique
        return response()->json([
            "success" => true,
            "message" => "Client trouvé",
            "data" => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        // Validation des données
        $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:clients,email,' . $client->client_id,
            'phone' => 'required|digits:10',
            'address' => 'required|string',
            'type' => 'required',
        ]);

        // Mise à jour du client
        $client->update($request->all());

        // Retourne la réponse JSON avec le client mis à jour
        return response()->json([
            "success" => true,
            "message" => "Client mis à jour avec succès",
            "data" => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        // Suppression du client
        $client->delete();

        // Retourne la réponse JSON avec un message de succès
        return response()->json([
            "success" => true,
            "message" => "Client supprimé avec succès",
            "data" => null
        ]);
    }
}
