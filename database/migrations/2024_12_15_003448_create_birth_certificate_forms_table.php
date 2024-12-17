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
        Schema::create('birth_certificate_forms', function (Blueprint $table) {
            $table->id();
            // Child Details
            $table->string('n_first_name', 100);
            $table->string('n_middle_name', 100)->nullable();
            $table->string('n_surname', 100);
            $table->string('e_first_name', 100);
            $table->string('e_middle_name', 100)->nullable();
            $table->string('e_surname', 100);
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('birth_type', ['single', 'twins', 'tripletsOrMore']);
            $table->boolean('is_weight_taken')->nullable();
            $table->integer('birth_weight')->nullable(); // in grams.
            $table->enum('birth_attendant_type', ['doctor', 'nurse', 'localSudini', 'trainedSudini', 'familyMembers', 'others']); // doctor, nurse, anm
            $table->enum('birth_place', ['home', 'healthpost', 'hospital', 'other']);
            $table->string('birth_province', 50)->nullable();
            $table->string('birth_municipality', 100)->nullable();
            $table->integer('birth_ward')->nullable();

            // If born in foreign
            $table->string('birth_country', 100)->nullable();
            $table->string('birth_state', 100)->nullable();
            $table->string('birth_local_address', 255)->nullable();

            // If disabled
            $table->text('disable_type')->nullable();

            // Grandfather's Details
            $table->string('n_grandfather_first_name', 100)->nullable();
            $table->string('n_grandfather_middle_name', 100)->nullable();
            $table->string('n_grandfather_last_name', 100)->nullable();
            $table->string('e_grandfather_first_name', 100)->nullable();
            $table->string('e_grandfather_middle_name', 100)->nullable();
            $table->string('e_grandfather_last_name', 100)->nullable();

            // Father's Details
            $table->string('n_father_first_name', 100)->nullable();
            $table->string('n_father_middle_name', 100)->nullable();
            $table->string('n_father_last_name', 100)->nullable();
            $table->string('e_father_first_name', 100)->nullable();
            $table->string('e_father_middle_name', 100)->nullable();
            $table->string('e_father_last_name', 100)->nullable();

            // Mother's Details
            $table->string('n_mother_first_name', 100)->nullable();
            $table->string('n_mother_middle_name', 100)->nullable();
            $table->string('n_mother_last_name', 100)->nullable();
            $table->string('e_mother_first_name', 100)->nullable();
            $table->string('e_mother_middle_name', 100)->nullable();
            $table->string('e_mother_last_name', 100)->nullable();

            // Parent Details
            $table->string('father_province', 50)->nullable();
            $table->string('father_municipality', 100)->nullable();
            $table->integer('father_ward')->nullable();
            $table->string('father_street', 100)->nullable();
            $table->string('father_village', 100)->nullable();
            $table->integer('father_house_no')->nullable();
            $table->string(column: 'father_citizenship_no', 50)->nullable();
            $table->date('father_dob')->nullable();
            $table->string('father_education', 100)->nullable();
            $table->text('father_occupation')->nullable();
            $table->string('father_religion', 50)->nullable();
            $table->string('father_cast', 50)->nullable();

            $table->string('mother_province', 50)->nullable();
            $table->string('mother_municipality', 100)->nullable();
            $table->integer('mother_ward')->nullable();
            $table->string('mother_street', 100)->nullable();
            $table->string('mother_village', 100)->nullable();
            $table->integer('mother_house_no')->nullable();
            $table->string('mother_citizenship_no', 50)->nullable();
            $table->date('mother_dob')->nullable();
            $table->string('mother_education', 100)->nullable();
            $table->text('mother_occupation')->nullable();
            $table->string('mother_religion', 50)->nullable();
            $table->string('mother_cast', 50)->nullable();

            // If foreigner parent
            $table->string('father_passport_no', 50)->nullable();
            $table->string('father_country', 100)->nullable();
            $table->string('mother_passport_no', 50)->nullable();
            $table->string('mother_country', 100)->nullable();

            // Parent marriage details
            $table->string('marriage_registration_no', 50)->nullable();
            $table->date('marriage_date')->nullable();

            // Informer details
            $table->string('n_informer_first_name', 100);
            $table->string('n_informer_middle_name', 100)->nullable();
            $table->string('n_informer_last_name', 100);
            $table->string('e_informer_first_name', 100);
            $table->string('e_informer_middle_name', 100)->nullable();
            $table->string('e_informer_last_name', 100);
            $table->string('informer_relation_with_child', 50);

            $table->string('citizenship_number', 50)->nullable();
            // If foreigner
            $table->string('passport_number', 50)->nullable();

            $table->string('issued_country', 100)->nullable();

            $table->date('form_filled_date')->default(now());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birth_certificate_forms');
    }
};
