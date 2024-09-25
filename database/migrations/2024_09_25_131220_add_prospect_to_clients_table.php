<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProspectToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->boolean('prospect')->default(false); // Ajout de la colonne 'prospect'
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('prospect'); // Suppression de la colonne 'prospect'
        });
    }
}