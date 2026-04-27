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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('mensagem');
            $table->string('rota');
            $table->string('codigo');
            $table->string('erro')->nullable();
            $table->foreignId('tipo_operacao_log_id')->constrained();
            $table->foreignId('entidade_log_id')->constrained();
            $table->timestamps();
            $table->index(['tipo_operacao_log_id', 'entidade_log_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
