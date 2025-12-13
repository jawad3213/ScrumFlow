<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validation des données entrantes
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Tentative de connexion
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Identifiants invalides'
            ], 401);
        }

        // 3. Récupération de l'utilisateur
        $user = User::where('email', $request->email)->firstOrFail();

        // 4. Création du Token (Jeton d'accès)
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Retourner la réponse JSON
        return response()->json([
            'message' => 'Connexion réussie',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user // On renvoie aussi les infos du user (rôle, nom, etc.)
        ]);
    }
    
    // Optionnel : Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
