<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->foreignId('id')
                ->constrained('clients', 'id')
                ->onDelete('restrict')  // Interdit la suppression d'un client s'il a des rendez-vous
                ->nullable();
                
            // $table->foreignId('salesperson_id')
            //     ->constrained('users', 'users_id')
            //     ->onDelete('restrict');  // Interdit la suppression d'un employeur s'il a des rendez-vous
                
            $table->dateTime('date_time');
            $table->string('location', 255);
            $table->enum('status', ['Planned', 'Realized', 'Canceled']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}