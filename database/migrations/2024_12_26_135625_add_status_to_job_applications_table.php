<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToJobApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->string('status')->default('submitted')->after('cv_path');
        });
    }

    public function down()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

