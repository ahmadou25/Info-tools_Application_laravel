<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['Manager', 'Salesperson']); // Colonne pour spécifier le rôle
            $table->integer('ad_id')->nullable();
            // $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

              // Ajout des nouvelles colonnes
              $table->string('address')->nullable();  // Colonne pour l'adresse
              $table->string('phone_number')->nullable(); // Colonne pour le numéro de téléphone
              $table->date('start_date')->nullable(); // Colonne pour la date de début
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
