<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id('id_utilisateur');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('date_naissance')->nullable();
            $table->string('numero_telephone')->nullable();
            $table->enum('role', ['chef', 'employe'])->default('employe');
            $table->string('status')->default('actif'); 
            $table->string('specialite')->nullable();

            // Relation "Gérer" (optionnel mais utile selon votre schéma)
            // Permet de dire "Cet employé est géré par ce chef"
            $table->foreignId('chef_id')
                  ->nullable()
                  ->constrained('users', 'id_utilisateur')
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};