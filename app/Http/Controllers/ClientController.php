<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Récupérez tous les clients ou appliquez un filtre si un nom est donné
        $clients = Client::when($request->filled('search'), function($query) use ($request) {
            return $query->where('first_name', 'like', '%'.$request->search.'%')
                         ->orWhere('last_name', 'like', '%'.$request->search.'%');
        })
        ->paginate(50); // Ajoutez la pagination pour afficher 50 clients par page
    
        // Retournez la vue avec la liste des clients filtrée et paginée
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

            'function' => 'required|string|max:255', // ✅ Ajout
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

            'function.required' => 'Vous devez entrer une fonction.', // ✅ Ajout
        ];
    
        $request->validate($rules, $customMessages);
    
        // Utilisez 'only' pour spécifier les champs autorisés
        Client::create($request->only(['last_name', 'first_name', 'email', 'phone', 'address', 'type', 'function']));
        
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

            'function', // ✅ Ajout
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

            'function.required' => 'Vous devez entrer une fonction.', // ✅ Ajout
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
        // Vérifiez si l'utilisateur connecté est un manager
        $manager = Auth::user();
    
        if (!$manager->isManager()) {
            // Retourne une erreur 403 si l'utilisateur n'est pas un manager
            abort(403, 'Accès interdit : seuls les managers peuvent effectuer cette action.');
        }
    
        // Vérifiez si des commandes sont associées au client
        // Vérifiez si des commandes ou rendez-vous sont associés au client
        if ($client->orders()->exists() || $client->appointments()->exists()) {
            return redirect()->route('clients.index')
                ->with('error', 'Impossible de supprimer ce client : il existe des commandes ou rendez-vous associés.');
        }
    
        // Supprimez le client s'il n'a pas de commandes associées
        $client->delete();
    
        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès !');
    }
}
