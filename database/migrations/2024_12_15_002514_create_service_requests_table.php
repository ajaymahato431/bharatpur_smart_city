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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to the users table
            $table->unsignedBigInteger('related_request_id')->nullable(); // Polymorphic ID
            $table->string('related_request_type')->nullable(); // Polymorphic type
            $table->enum('status', ['pending', 'verified', 'approved', 'rejected'])->default('pending'); // Status
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Composite Index for Polymorphic Relationship
            $table->index(['related_request_id', 'related_request_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
