<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('current_employments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->string('post_name');
            $table->string('organisation_type');
            $table->string('employer_name');
            $table->string('employer_address');
            $table->date('commencement_date');
            $table->string('employment_nature');
            $table->decimal('monthly_salary', 10, 2);
            $table->decimal('allowance', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_employments');
    }
};
