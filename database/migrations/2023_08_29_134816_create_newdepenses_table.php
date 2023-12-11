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
        Schema::create('newdepenses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('code_discipline');
            $table->string('code_depense');
            $table->decimal('montant_depense', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newdepenses');
    }
};
