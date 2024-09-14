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
        Schema::create('expense_journal_models', function (Blueprint $table) {
            $table->id();
            $table->string('date_depense')->nullable();
            $table->string('pc_number')->nullable();
            $table->string('designation')->nullable();
            $table->integer('quantity')->nullable();
            $table->bigInteger('unit_price')->nullable();
            $table->bigInteger('montant_designation')->nullable();
            $table->bigInteger('cumul_montant_designation')->nullable();
            $table->longText('observation')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_journal_models');
    }
};
