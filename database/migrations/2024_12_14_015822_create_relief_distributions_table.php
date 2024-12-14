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
        Schema::create('relief_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disaster_report_id')->constrained('disaster_reports')->onDelete('cascade');
            $table->date('distribution_date');
            $table->string('material_type');
            $table->unsignedInteger('quantity');
            $table->string('distributed_to');
            $table->string('receiver_contact');
            $table->string('distributed_by');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relief_distributions');
    }
};
