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
        Schema::create('school_qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->string('school_qualification');
            $table->string('certificate_title')->nullable();
            $table->string('school_college_name')->nullable();
            $table->date('certificate_date')->nullable();
            $table->string('college_result')->nullable(); // Updated field name
            $table->string('bahasa_melayu_result')->nullable();
            $table->string('english_result')->nullable();
            $table->string('mathematics_result')->nullable();
            $table->string('other_subjects')->nullable();
            $table->string('subjects_result')->nullable(); // Change from enum to string
            $table->string('moe_accreditation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_qualifications');
    }
};
