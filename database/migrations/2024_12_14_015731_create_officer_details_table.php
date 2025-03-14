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
        Schema::create('officer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('officer_id')->constrained('officers')->onDelete('cascade');
            $table->string('staff_no');
            $table->string('citizenship_no');
            $table->string('citizenship_front_image');
            $table->string('citizenship_back_image');
            $table->string('job_position');
            $table->unsignedInteger('ward_no')->default(10);
            $table->string('address');
            $table->date('dob');
            $table->string('gender');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officer_details');
    }
};
