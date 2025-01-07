<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Valider les informations d'identification
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Vérifie si l'utilisateur existe
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        // Supprimer l'ancien token de cet utilisateur (si existant)
        $user->tokens()->delete();

        // Créer un nouveau token
        $newToken = $user->createToken('API Token', ['*']);
        $plainTextToken = $newToken->plainTextToken;

        // Extraire la partie après le "|"
        $tokenParts = explode('|', $plainTextToken);
        $tokenWithoutPrefix = $tokenParts[1] ?? $plainTextToken;

        // Retourner uniquement la partie sans le préfixe
        return response()->json([
            'token' => $tokenWithoutPrefix,
            'id' => $user->id, // Ajout de l'ID utilisateur
        ], 200);
    }
}
