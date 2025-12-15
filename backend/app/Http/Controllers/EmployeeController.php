<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\WelcomeEmployeeMail;

class EmployeeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation des données
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'job_title' => 'required|string|max:255',
        ]);

        // 2. Générer un mot de passe aléatoire
        $generatedPassword = Str::random(10); // Mot de passe de 10 caractères

        // 3. Créer l'utilisateur
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'job_title' => $request->job_title,
            'role' => 'employee', // Rôle forcé à 'employee'
            'password' => Hash::make($generatedPassword),
            'status' => 'active', // Par défaut actif
        ]);

         //Envoyer l'email de bienvenue (Commenté pour découpler du template Blade comme demandé)
         try {
             Mail::to($user->email)->send(new WelcomeEmployeeMail($user, $generatedPassword));
         } catch (\Exception $e) {
            Log::error('Erreur envoi email bienvenue : ' . $e->getMessage());
         }

        // 5. Retourner la réponse avec le mot de passe généré pour l'affichage côté React
        return response()->json([
            'message' => 'Employé créé avec succès.',
            'user' => $user,
            'generated_password' => $generatedPassword // Le mot de passe est retourné ici pour que le React App puisse l'afficher
        ], 201);
    }
}
