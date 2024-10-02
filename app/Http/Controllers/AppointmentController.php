<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'client_id' => 'required|integer',
            'salesperson_id' => 'required|integer',
            'location' => 'required|string',
            'status' => 'required|string',
        ];

        $customMessages = [
            'client_id.required' => 'Vous devez entrer un identifiant client.',
            'salesperson_id.required' => 'Vous devez entrer un identifiant commercial.',
            'location.required' => 'Vous devez entrer une localisation.',
            'status.required' => 'Vous devez entrer un statut.',
        ];

        $request->validate($rules, $customMessages);

        Appointment::create($request->all());
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $rules = [
            'client_id' => 'required|integer',
            'salesperson_id' => 'required|integer',
            'location' => 'required|string',
            'status' => 'required|string',
        ];

        $customMessages = [
            'client_id.required' => 'Vous devez entrer un identifiant client.',
            'salesperson_id.required' => 'Vous devez entrer un identifiant commercial.',
            'location.required' => 'Vous devez entrer une localisation.',
            'status.required' => 'Vous devez entrer un statut.',
        ];

        $request->validate($rules, $customMessages);

        $appointment->update($request->all());
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment supprimé avec succès');
    }
}
