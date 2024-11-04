<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
{
    Schema::table('ingresoexterno', function (Blueprint $table) {
        $table->integer('ultima_cantidad_egresada')->default(0); // O null, dependiendo de tus requerimientos
    });
}

public function down()
{
    Schema::table('ingresoexterno', function (Blueprint $table) {
        $table->dropColumn('ultima_cantidad_egresada');
    });
}
};
