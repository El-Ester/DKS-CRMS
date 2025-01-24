<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id'); // Assuming it's linked to a user
            // Previous Employment
            $table->string('post_name')->nullable();
            $table->string('employer_name')->nullable();
            $table->text('employer_address')->nullable();
            $table->date('commencement_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->string('employment_nature')->nullable();
            $table->string('reasons_for_leaving')->nullable();

            // Current Employment
            $table->string('current_post_name')->nullable();
            $table->string('organisation_type')->nullable(); // e.g., government, non-government
            $table->text('current_employer_name')->nullable();
            $table->text('current_employer_address')->nullable();
            $table->date('current_commencement_date')->nullable();
            $table->string('current_employment_nature')->nullable();
            $table->decimal('monthly_salary', 10, 2)->nullable();
            $table->decimal('allowance', 10, 2)->nullable();

            // Applied for the same post
            $table->string('applied_for_post')->nullable();
            $table->date('date_of_appointment')->nullable();
            $table->string('result')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employments');
    }

};
