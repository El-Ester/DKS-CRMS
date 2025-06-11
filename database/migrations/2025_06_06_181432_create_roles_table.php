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
        Schema::create('roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_title');
            $table->string('role_description')->nullable();
            $table->date('created_date')->nullable();
            $table->string('created_by_username')->nullable();
            $table->date('modified_date')->nullable();
            $table->string('modified_by_username')->nullable();
            $table->boolean('is_suspended')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
