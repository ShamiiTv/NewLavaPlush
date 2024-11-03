<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToIngresosRopaTable extends Migration
{
    public function up()
    {
        Schema::table('ingresointerno', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Añadir el campo user_id
        });
    }

    public function down()
    {
        Schema::table('ingresointerno', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
