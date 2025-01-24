<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHigherEducationQualificationsTable extends Migration
{
    public function up()
    {
        Schema::create('higher_education_qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->string('qualification_type'); // ND, HND, BA, MA
            $table->string('university_name')->nullable();
            $table->string('university_country')->nullable();
            $table->string('certificate_name')->nullable();
            $table->date('certificate_date')->nullable();
            $table->string('overall_result');
            $table->string('moe_accreditation')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('higher_education_qualifications');
    }
}
