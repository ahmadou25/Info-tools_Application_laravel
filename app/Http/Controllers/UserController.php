<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Affiche la liste des commerciaux attribués au Manager connecté.
     */
    public function index(Request $request)
    {
        $manager = Auth::user();
    
        if (!$manager->isManager()) {
            abort(403, 'Accès interdit. Vous devez être un Manager pour accéder à cette page.');
        }
    
        // Initialisation de la requête
        $query = User::where('role', 'Salesperson');
    
        // Application de la recherche si le paramètre est présent
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('last_name', 'like', '%'.$request->search.'%')
                  ->orWhere('first_name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }
    
        // Pagination des résultats
        $users = $query->paginate(10);
    
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
            'address' => 'nullable|string|max:255', // Validation pour l'adresse
            'phone_number' => 'nullable|string|max:20', // Validation pour le numéro de téléphone
            'start_date' => 'nullable|date', // Validation pour la date de début
        ]);

        // Données à enregistrer
        $data = $request->only(['first_name', 'last_name', 'email', 'role', 'address', 'phone_number', 'start_date']);
        $data['password'] = Hash::make($request->password);  // Utilisation de Hash pour sécuriser le mot de passe

        // Si un Manager crée un utilisateur, associer automatiquement son ID
        if (auth()->user()->role === 'Manager') {
            $data['ad_id'] = auth()->user()->id;
        }

        // Création de l'utilisateur
        User::create($data);

        // Redirection avec un message de succès
        return redirect()->route('users.index')->with('success', 'Commercial créé avec succès.');
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
            'address' => 'nullable|string|max:255', // Validation pour l'adresse
            'phone_number' => 'nullable|string|max:20', // Validation pour le numéro de téléphone
            'start_date' => 'nullable|date', // Validation pour la date de début
        ]);

        // Données à mettre à jour
        $data = $request->only(['first_name', 'last_name', 'email', 'role', 'address', 'phone_number', 'start_date']);

        // Si un mot de passe est fourni, le hacher
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Si l'utilisateur est un Admin, permettre la modification du Manager associé
        if (auth()->user()->role === 'Admin') {
            $data['ad_id'] = $request->ad_id;
        }

        // Mise à jour de l'utilisateur
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Commercial mis à jour avec succès.');
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

        if ($user->appointments()->exists()) {
            return redirect()->route('users.index')
                ->with('error', 'Impossible de supprimer cet utilisateur car il a des rendez-vous associés.');
        }
        
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Commercial supprimé avec succès.');
    }
}
