<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('ai_analyses', function (Blueprint $table) {
        $table->id();
        $table->string('cahier_charge_name');
        $table->string('file_path');
        $table->json('analysis_result')->nullable();
        $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');

        // Lien vers le Chef (celui qui lance l'analyse)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // On met 'nullable' au cas où on voudrait lancer une analyse sans projet au début, 
        $table->foreignId('project_id')->constrained()->onDelete('cascade'); 

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_i_analyses');
    }
};
