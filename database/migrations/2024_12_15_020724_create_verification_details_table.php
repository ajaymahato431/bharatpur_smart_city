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
        Schema::create('verification_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_request_id')->constrained()->cascadeOnDelete(); // Foreign Key: Links to the service_requests table
            $table->foreignId('officer_id')->constrained(); // Foreign Key: Links to the officers table
            $table->string('form_no')->nullable(); // Form Number
            $table->date('form_date')->nullable(); // Date of Form
            $table->string('family_cost_no')->nullable(); // Family Cost Number
            $table->string('municipality')->nullable(); // Municipality Name
            $table->integer('ward')->nullable(); // Ward Naumber
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_details');
    }
};
