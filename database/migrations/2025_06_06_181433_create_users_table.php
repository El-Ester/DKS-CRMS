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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_name');
            $table->string('user_full_name');
            $table->string('user_email')->unique();
            $table->string('user_password');
            $table->dateTime('last_login')->nullable();
            $table->date('created_date')->nullable();
            $table->string('created_by_username')->nullable();
            $table->date('modified_date')->nullable();
            $table->string('modified_by_username')->nullable();
            $table->boolean('is_suspended')->default(false);
            $table->unsignedBigInteger('user_role');
            $table->timestamps();

            $table->foreign('user_role')->references('role_id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
