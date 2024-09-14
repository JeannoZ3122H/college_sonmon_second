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
        Schema::create('computer_registration_models', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->unsigned();
            $table->integer('scolarite_computer_science_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('matricule')->nullable();
            $table->string('inscription_years')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computer_registration_models');
    }
};
