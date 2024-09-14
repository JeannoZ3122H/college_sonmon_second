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
        Schema::create('journal_other_cash_entries_models', function (Blueprint $table) {
            $table->id();
            $table->string('autre_date_depense')->nullable();
            $table->string('autre_pc_number')->nullable();
            $table->string('autre_designation')->nullable();
            $table->integer('autre_quantity')->nullable();
            $table->bigInteger('autre_unit_price')->nullable();
            $table->bigInteger('autre_montant_designation')->nullable();
            $table->bigInteger('autre_cumul_montant_designation')->nullable();
            $table->longText('autre_observation')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_other_cash_entries_models');
    }
};
