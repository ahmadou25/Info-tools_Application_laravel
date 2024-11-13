<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        // Appliquer des autorisations globales aux méthodes standards
        $this->authorizeResource(Client::class, 'client');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Autorisation globale avec 'authorizeResource' déjà appliquée
        $clients = Client::all();
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
        // Vérifie si l'utilisateur est autorisé à créer
        $this->authorize('create', Client::class);
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Autorisation automatique via 'authorizeResource' et validation des données
        $this->authorize('create', Client::class);

        $rules = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|digits:10',
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
        $this->authorize('view', $client);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $this->authorize('update', $client);
        return view('clients.edit', compact('client'));
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
        $this->authorize('update', $client);

        $rules = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:clients,email',
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
        $this->authorize('delete', $client);
        $client->delete();
        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès !');
    }
}
