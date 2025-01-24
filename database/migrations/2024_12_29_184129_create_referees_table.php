<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('referees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id'); // Assuming it's linked to a user
            $table->string('name');
            $table->string('occupation');
            $table->integer('years_known');
            $table->string('relation');
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('address_line3')->nullable();
            $table->string('country');
            $table->string('province');
            $table->string('postal_code');
            $table->string('telephone');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('referees');
    }

};
