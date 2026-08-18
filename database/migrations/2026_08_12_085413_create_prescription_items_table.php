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
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')
            ->constrained('prescriptions')
            ->cascadeOnDelete();
            $table->foreignId('medicine_id')
            ->constrained('medicines')
            ->restrictOnDelete();
            $table->unsignedInteger('quantity');

            $table->string('dousage');
            $table->text('usage_instruction');

            $table->timestamps();
            $table->unique([
                'prescription_id',
                'medicine_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};
