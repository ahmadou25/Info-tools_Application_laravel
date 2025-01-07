<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all(); // Récupérer tous les clients
        return view('clients.index', compact('clients'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create'); // Afficher le formulaire de création
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données
        $rules = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:clients,email', // Vérifiez l'unicité de l'email
            'phone' => 'required|digits:10', // Vérifiez que le numéro de téléphone a 10 chiffres
            'address' => 'required|string',
            'type' => 'required',
        ];
    
        $customMessages = [
            'last_name.required' => 'Vous devez entrer un nom.',
            'first_name.required' => 'Vous devez entrer un prénom.',
            'email.required' => 'Vous devez entrer une adresse email valide.',
            'email.email' => 'Le format de l\'email n\'est pas valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.required' => 'Vous devez entrer un numéro de téléphone valide.',
            'phone.digits' => 'Le numéro de téléphone doit avoir 10 chiffres.',
            'address.required' => 'Vous devez entrer une adresse.',
            'type.required' => 'Vous devez entrer un type.',
        ];
    
        $request->validate($rules, $customMessages);
    
        // Utilisez 'only' pour spécifier les champs autorisés
        Client::create($request->only(['last_name', 'first_name', 'email', 'phone', 'address', 'type']));
        
        return redirect()->route('clients.index')
            ->with('success', 'Client ajouté avec succès !');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client')); // Afficher les détails d'un client
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client')); // Afficher le formulaire d'édition
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
        $rules = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'required|min:10',
            'address' => 'required',
            'type' => 'required',
        ];

        $customMessages = [
            'last_name.required' => 'Vous devez entrer un nom.',
            'first_name.required' => 'Vous devez entrer un prénom.',
            'email.required' => 'Vous devez entrer une adresse email valide.',
            'email.email' => 'Le format de l\'email n\'est pas valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.required' => 'Vous devez entrer un numéro de téléphone valide.',
            'address.required' => 'Vous devez entrer une adresse.',
            'type.required' => 'Vous devez entrer un type.',
        ];

        $request->validate($rules, $customMessages);

        $client->update($request->all());
        return redirect()->route('clients.index')
            ->with('success', 'Client mis à jour avec succès');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        // Vérifiez si des commandes sont associées au client
        if ($client->orders()->exists()) {
            return redirect()->route('clients.index')
                ->with('error', 'Impossible de supprimer ce client : il existe des commandes associées.');
        }
    
        // Si aucune commande n'est associée, supprimez le client
        $client->delete();
    
        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès !');
    }
}
