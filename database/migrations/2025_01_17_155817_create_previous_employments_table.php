<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('previous_employments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->string('post_name');
            $table->string('employer_name');
            $table->string('employer_address');
            $table->date('commencement_date');
            $table->date('termination_date')->nullable();
            $table->string('employment_nature');
            $table->string('reasons_for_leaving');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('previous_employments');
    }
};
