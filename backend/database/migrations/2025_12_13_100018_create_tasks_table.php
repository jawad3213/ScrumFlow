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
       Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
        $table->string('title');
        $table->text('description')->nullable();
        $table->enum('status', ['todo', 'in_progress', 'done'])->default('todo');
        $table->integer('complexity')->default(1); // Story points
        $table->foreignId('sprint_id')->constrained()->onDelete('cascade');
        $table->foreignId('parent_id')->nullable()->constrained('tasks')->onDelete('cascade');// cette attribut permet de lier une tache a une autre tache mere
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
