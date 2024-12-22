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
            $table->id();
            $table->string('job_description', 500);
            $table->text('required_skills');
            $table->string('education_experience', 255);
            $table->date('posted_date');
            $table->string('location', 255);
            $table->integer('vacancy');
            $table->string('job_nature', 50); // e.g., Full-time, Part-time, etc.
            $table->decimal('salary', 10, 2); // Salary in decimal format
            $table->date('application_date');
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
