<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatePictureTable extends Migration
{
    public function up()
    {
        Schema::create('candidate_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade'); // User who uploaded the picture
            $table->string('picture'); // Path to the uploaded picture
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_pictures'); // Corrected table name
    }
};
