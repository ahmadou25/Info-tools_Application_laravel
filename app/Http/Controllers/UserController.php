<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importation ajoutée
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Affiche la liste des commerciaux attribués au Manager connecté.
     */
    public function index()
    {
        $manager = Auth::user();

        if (!$manager->isManager()) {
            abort(403, 'Accès interdit. Vous devez être un Manager pour accéder à cette page.');
        }

    // Récupérer tous les commerciaux sans se limiter au manager connecté
    $users = User::where('role', 'Salesperson')->paginate(10);

    // Retourner la vue avec tous les commerciaux
    return view('users.index', compact('users'));
    }

    public function show($id)
    {
        // Récupérer l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Retourner une vue avec l'utilisateur
        return view('users.show', compact('user'));
    }

    /**
     * Affiche le formulaire pour ajouter un nouveau commercial.
     */
    public function create()
    {
        $managers = [];
        if (auth()->user()->role === 'Admin') {
            // Si l'utilisateur est un Admin, il peut voir tous les Managers
            $managers = User::where('role', 'Manager')->get();
        }
    
        return view('users.create', compact('managers'));
    }
    
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Salesperson,Manager',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Données à enregistrer
        $data = $request->only(['first_name', 'last_name', 'email', 'role']);
        $data['password'] = Hash::make($request->password);  // Utilisation de Hash pour sécuriser le mot de passe

        // Si un Manager crée un utilisateur, associer automatiquement son ID
        if (auth()->user()->role === 'Manager') {
            $data['ad_id'] = auth()->user()->id;
        }

        // Création de l'utilisateur
        User::create($data);

        // Redirection avec un message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }
    

    /**
     * Affiche le formulaire d'édition d'un commercial.
     */
    public function edit(User $user)
    {
        $managers = [];
        if (auth()->user()->role === 'Admin') {
            // Si l'utilisateur est un Admin, récupérer tous les Managers
            $managers = User::where('role', 'Manager')->get();
        }
    
        return view('users.edit', compact('user', 'managers'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:Salesperson,Manager',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        $data = $request->only(['first_name', 'last_name', 'email', 'role']);
    
        // Si un mot de passe est fourni, le hacher
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        // Si l'utilisateur est un Admin, permettre la modification du Manager associé
        if (auth()->user()->role === 'Admin') {
            $data['ad_id'] = $request->ad_id;
        }
    
        $user->update($data);
    
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }
    
    /**
     * Supprime un commercial.
     */
    public function destroy(User $user)
    {
        $manager = Auth::user();

        if (!$manager->isManager()) {
            abort(403, 'Accès interdit.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Commercial supprimé avec succès.');
    }
}