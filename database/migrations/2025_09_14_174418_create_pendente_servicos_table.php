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
        Schema::create('pendente_servicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendente_id')->constrained();
            $table->foreignId('servico_id')->constrained();
            $table->timestamps();
            $table->index(['servico_id', 'pendente_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendente_servicos');
    }
};
