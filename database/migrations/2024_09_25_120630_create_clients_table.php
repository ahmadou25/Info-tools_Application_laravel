<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('id');
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('email', 100)->unique(); 
            $table->string('phone', 15);
            $table->string('address', 255);
            $table->string('function', 100)->default('Inconnue');
            $table->enum('type', ['prosper', 'client'])->default('client');  // Type de client avec 'client' comme valeur par défaut
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

