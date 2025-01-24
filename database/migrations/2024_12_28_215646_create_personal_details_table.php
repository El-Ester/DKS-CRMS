<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('personal_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id'); // Assuming it's linked to a user
            $table->string('name');
            $table->string('identity_card_no');
            $table->date('date_of_issue');
            $table->date('date_of_birth');
            $table->integer('age');
            $table->string('place_of_birth');
            $table->enum('gender', ['Female', 'Male']);
            $table->enum('marital_status', ['Single', 'Married', 'Others'])->nullable();
            $table->string('race');
            $table->enum('religion', ['Muslim', 'Non-Muslim']);
            $table->string('citizenship');
            $table->string('certificate_number');
            $table->string('driving_licence')->nullable();
            $table->string('licence_class')->nullable();
            $table->string('tel_house')->nullable();
            $table->string('tel_mobile');
            $table->string('tel_fax')->nullable();
            $table->string('email')->unique();
            $table->string('permanent_address_line1');
            $table->string('permanent_address_line2')->nullable();
            $table->string('permanent_country');
            $table->string('permanent_province');
            $table->string('permanent_postal_code');
            $table->string('postal_address_line1');
            $table->string('postal_address_line2')->nullable();
            $table->string('postal_country');
            $table->string('postal_province');
            $table->string('postal_postal_code');
            $table->timestamps();
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_details');
    }
};
