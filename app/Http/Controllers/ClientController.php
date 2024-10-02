<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'address' => 'required',
            'type' => 'required',
        ];

        $customMessages = [
            'last_name.required' => 'Vous devez entrer un nom.',
            'first_name.required' => 'Vous devez entrer un prénom.',
            'email.required' => 'Vous devez entrer une adresse email valide.',
            'phone.required' => 'Vous devez entrer un numéro de téléphone valide.',
            'address.required' => 'Vous devez entrer une adresse.',
            'type.required' => 'Vous devez entrer un type.',
        ];

        $request->validate($rules, $customMessages);

        Client::create($request->all());
        return redirect()->route('clients.index')
            ->with('success', 'Client ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $rules = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'address' => 'required',
            'type' => 'required',
        ];

        $customMessages = [
            'last_name.required' => 'Vous devez entrer un nom.',
            'first_name.required' => 'Vous devez entrer un prénom.',
            'email.required' => 'Vous devez entrer une adresse email valide.',
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
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès');
    }
}
