<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom',250);
            $table->string('prenom',250);
            $table->string('email',250)->unique();
            $table->foreignId('id_departement')->nullable()->constrained('departements');
            $table->foreignId('id_role')->nullable()->constrained('roles');
            $table->string('telephone',250);
            $table->boolean('statut');
            $table->string('matricule',25);
            $table->string('password',250);
            $table->boolean('isactif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
