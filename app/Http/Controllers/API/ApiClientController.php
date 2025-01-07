<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ApiClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return response()->json([
            "success" => true,
            "message" => "Liste des clients",
            "data" => $clients
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|digits:10',
            'address' => 'required|string',
            'type' => 'required',
        ]);

        try {
            $client = Client::create($request->all());

            return response()->json([
                "success" => true,
                "message" => "Client créé avec succès",
                "data" => $client
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Erreur lors de la création du client",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function show(Client $client)
    {
        return response()->json([
            "success" => true,
            "message" => "Client trouvé",
            "data" => $client
        ], 200);
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'required|digits:10',
            'address' => 'required|string',
            'type' => 'required',
        ]);

        try {
            $client->update($request->all());

            return response()->json([
                "success" => true,
                "message" => "Client mis à jour avec succès",
                "data" => $client
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Erreur lors de la mise à jour du client",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Client $client)
    {
        try {
            $client->delete();

            return response()->json([
                "success" => true,
                "message" => "Client supprimé avec succès"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Erreur lors de la suppression du client",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
