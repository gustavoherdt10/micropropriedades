<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produtos_servicos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('propriedade_id')
                ->constrained('propriedades')
                ->cascadeOnDelete();

            $table->foreignId('categoria_id')
                ->nullable()
                ->constrained('categorias')
                ->nullOnDelete();

            $table->enum('tipo', ['produto', 'servico'])->default('produto');

            $table->string('nome', 150);
            $table->text('descricao')->nullable();

            $table->decimal('preco_estimado', 10, 2)->nullable();
            $table->string('unidade', 50)->nullable();
            $table->string('disponibilidade', 120)->nullable();

            $table->string('imagem')->nullable();
            $table->boolean('ativo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos_servicos');
    }
};