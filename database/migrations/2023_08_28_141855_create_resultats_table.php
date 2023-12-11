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
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->integer('rang');
            $table->foreignId('pays_id')->constrained()->onDelete('cascade');
            $table->foreignId('discipline_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultats');
    }
};
