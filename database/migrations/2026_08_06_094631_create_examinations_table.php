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
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')
            ->restrictOnDelete()->unique();
            $table->foreignId('doctor_id')->constrained('doctors')
            ->restrictOnDelete();
            $table->foreignId('patient_id')->constrained('patients')
            ->restrictOnDelete();
            $table->string('diagnosis');
            $table->text('note')->nullable();
            $table->dateTime('examinated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
