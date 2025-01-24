<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id'); // Assuming it's linked to a user
            $table->string('training_name');
            $table->date('date');
            $table->string('organiser');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainings');
    }

};
