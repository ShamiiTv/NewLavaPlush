<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosRopaTable extends Migration
{
    public function up()
    {
        Schema::create('ingresointerno', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_ropa', ['limpia', 'sucia']);
            $table->string('tipo_ropa_detalle');
            $table->integer('cantidad');
            $table->timestamps();

            // Asegura que no haya entradas duplicadas
            $table->unique(['tipo_ropa', 'tipo_ropa_detalle']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingresointerno');
    }
}

