<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('higher_education_qualification_id');
            $table->string('course_name');
            $table->string('course_result');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('higher_education_qualification_id')
                ->references('id')->on('higher_education_qualifications')
                ->onDelete('cascade'); // Ensures courses are deleted when qualification is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
