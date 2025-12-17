<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;

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

        // 3. Récupération de l'utilisateur directement depuis l'auth
        $user = Auth::user();

        // CHECK: Si l'utilisateur est banni
        if ($user->status === 'banned') {
            // on pourrait faire Auth::logout(); pour être sûr
            return response()->json([
                'message' => 'Votre compte est banni. Veuillez contacter l\'administrateur.'
            ], 403);
        }

        // 4. Création du Token (Jeton d'accès)
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Retourner la réponse JSON
        return response()->json([
            'message' => 'Connexion réussie',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user, // On renvoie aussi les infos du user (rôle, nom, etc.)
            'role' => $user->role,
        ]);
    }
    
    // Optionnel : Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    // 1. Demande de réinitialisation de mot de passe
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email non trouvé.'], 404);
        }

        // Générer un token
        $token = Str::random(60);

        // Stocker le token dans la base de données
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token, // Idéalement hasher le token, mais pour simplicité ici stocké tel quel ou comme demandé par l'utilisateur
                'created_at' => now(),
            ]
        );

        // Envoyer l'email
        try {
            Mail::to($request->email)->send(new ResetPasswordMail($token, $request->email));
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de l\'envoi de l\'email.'], 500);
        }

        return response()->json(['message' => 'Email de réinitialisation envoyé.']);
    }

    // 2. validation du token et changement du mot de passe
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed', // confirmed cherche un champ password_confirmation
        ]);

        // Vérifier le token
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
             return response()->json(['message' => 'Token invalide ou email incorrect.'], 400);
        }

        // Mettre à jour le mot de passe de l'utilisateur
        $user = User::where('email', $request->email)->first();
        if (!$user) {
             return response()->json(['message' => 'Utilisateur introuvable.'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Supprimer le token utilisé
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Mot de passe réinitialisé avec succès.']);
    }
}

