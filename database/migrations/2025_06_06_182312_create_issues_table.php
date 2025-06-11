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
        Schema::create('issues', function (Blueprint $table) {
            $table->id('issue_id');
            $table->string('issue_number')->unique();
            $table->date('issue_date');
            $table->string('customer_name');
            $table->string('company')->nullable();
            $table->string('contact_no');
            $table->string('customer_email');
            $table->text('problem_statement');
            $table->text('problem_verification')->nullable();
            $table->string('repair_cost')->nullable();
            $table->text('work_description')->nullable();
            $table->date('diagnostic_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->date('created_date')->nullable();
            $table->string('created_by_username')->nullable();
            $table->dateTime('modified_date')->nullable();
            $table->string('modified_by_username')->nullable();
            $table->boolean('is_suspended')->default(false);
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('status_id')->on('statuses');
            // $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
