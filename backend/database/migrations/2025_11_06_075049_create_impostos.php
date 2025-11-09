<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impostos', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('sigla', 10);
            $table->string('nome_completo');
            $table->string('icone', 50);
            $table->text('descricao');
            $table->text('finalidade');
            $table->json('curiosidades');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impostos');
    }
};
