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
        Schema::create('birth_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('birth_certificate_form_id')->constrained()->cascadeOnDelete();
            $table->string('citizenship_front')->nullable();
            $table->string('citizenship_back')->nullable();
            $table->string('hospital_birth_report')->nullable();
            $table->string('last_vaccine_proof')->nullable();
            $table->string('passport_copy')->nullable();
            $table->string('ward_residence_proof')->nullable();
            $table->string('indian_citizen_proof')->nullable();
            $table->string('nofather_police_report')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birth_certificate_form_documents');
    }
};
