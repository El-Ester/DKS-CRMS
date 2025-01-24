<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('family_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id'); // Assuming it's linked to a user
            $table->string('name'); // Name
            $table->enum('relation', ['Husabnd', 'Wife', 'Father', 'Mother', 'Children'])->nullable();
            $table->string('ic_no')->nullable(); // Identity Card Number
            $table->date('d_o_b')->nullable(); // Date of Birth
            $table->integer('age')->nullable(); // Age
            $table->string('occupation_or_education')->nullable(); // Occupation or Education
            $table->text('address')->nullable(); // Full Address
            $table->date('date_of_demise')->nullable(); // Date of Demise (if applicable)

            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_details');
    }
};
