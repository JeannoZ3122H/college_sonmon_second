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
        Schema::create('construction_expenses_journal_models', function (Blueprint $table) {
            $table->id();
            $table->string('construction_date_depense')->nullable();
            $table->string('construction_pc_number')->nullable();
            $table->string('construction_designation')->nullable();
            $table->integer('construction_quantity')->nullable();
            $table->bigInteger('construction_unit_price')->nullable();
            $table->bigInteger('construction_montant_designation')->nullable();
            $table->bigInteger('construction_cumul_montant_designation')->nullable();
            $table->longText('construction_observation')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('construction_expenses_journal_models');
    }
};
