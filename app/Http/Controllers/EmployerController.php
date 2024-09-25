<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    // Afficher tous les employeurs
    public function index()
    {
        $employers = Employer::all();
        return response()->json($employers);
    }

    // Créer un nouvel employeur
    public function store(Request $request)
    {
        $employer = Employer::create($request->all());
        return response()->json($employer, 201);
    }

    // Afficher un employeur spécifique
    public function show($id)
    {
        $employer = Employer::find($id);
        return response()->json($employer);
    }

    // Mettre à jour un employeur
    public function update(Request $request, $id)
    {
        $employer = Employer::find($id);
        $employer->update($request->all());
        return response()->json($employer);
    }

    // Supprimer un employeur
    public function destroy($id)
    {
        Employer::destroy($id);
        return response()->json(null, 204);
    }
}
