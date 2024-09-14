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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->unsigned();
            $table->integer('niveau_etude_id')->unsigned();
            $table->integer('scolarite_id')->unsigned();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('matricule')->nullable();
            $table->string('classroom')->nullable();
            $table->string('fullname_mather')->nullable();
            $table->string('fullname_father')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('scolarite_years')->nullable();
            $table->string('scolarite_reste')->nullable();
            $table->string('scolarite_total')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
