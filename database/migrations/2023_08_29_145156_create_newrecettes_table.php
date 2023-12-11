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
        Schema::create('newrecettes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('code_discipline');
            $table->string('code_recette');
            $table->decimal('montant_recette', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newrecettes');
    }
};
