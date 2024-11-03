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
        Schema::create('ingresoexterno', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_ropa', ['limpia', 'sucia']);
            $table->string('tipo_ropa_detalle');
            $table->integer('cantidad');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clave foránea para user_id
            $table->timestamps();

            // Asegura que no haya entradas duplicadas
            $table->unique(['tipo_ropa', 'tipo_ropa_detalle']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresoexterno');

    }
};
