<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('editor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title'); // Job title
            $table->text('description'); // Job description
            $table->decimal('payment_amount', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->text('working_period')->nullable(); // Change to text field for working period
            $table->text('min_requirements')->nullable();
            $table->text('document_required')->nullable(); // Use 'text' for longer input
            $table->date('open_date');
            $table->date('close_date');
            $table->enum('status', ['draft', 'open', 'closed'])->default('draft');
            $table->timestamp('edited_at')->nullable();
            $table->string('edited_by')->nullable();
            $table->enum('job_type', [
                'academic_post_local',
                'non_academic_post_local',
                'academic_post_expatriates'
            ])->default('academic_post_local');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
