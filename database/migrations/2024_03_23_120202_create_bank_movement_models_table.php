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
        Schema::create('bank_movement_models', function (Blueprint $table) {
            $table->id();
            $table->string('movement_bank_date')->nullable();
            $table->string('movement_bank_libelle')->nullable();
            $table->string('bank')->nullable();
            $table->bigInteger('versement_bank')->nullable();
            $table->string('alimentation_box_by_bank')->nullable();
            $table->bigInteger('balances')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_movement_models');
    }
};
