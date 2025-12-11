
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {

            $table->id('id_tache');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('status', ['en_attente', 'en_cours', 'terminee', 'annulee'])
                  ->default('en_attente');
            
            $table->dateTime('date_limitee')->nullable();
            $table->dateTime('date_achevement')->nullable();
            $table->dateTime('date_debut')->useCurrent();

            $table->foreignId('cree_par_id')
                  ->constrained('users', 'id_utilisateur')
                  ->onDelete('cascade');

            
            $table->foreignId('assigne_a_id')
                  ->nullable() // Nullable car on peut créer une tâche sans l'attribuer tout de suite
                  ->constrained('users', 'id_utilisateur')
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};