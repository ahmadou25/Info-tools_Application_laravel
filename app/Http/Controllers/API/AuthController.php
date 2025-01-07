<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Connexion d'un utilisateur et génération de token.
     */
    public function login(Request $request)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Vérifier si l'utilisateur existe
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Identifiants incorrects',
            ], 401);
        }
    
        // Générer le token
        $token = $user->createToken('AppName')->plainTextToken;
    
        // Retourner le token et les informations de l'utilisateur
        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email
                ]
            ]
        ]);
    }
    

    /**
     * Déconnexion de l'utilisateur (révoque les tokens).
     */
    public function logout(Request $request)
    {
        // Révoque tous les tokens de l'utilisateur connecté
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }
}
