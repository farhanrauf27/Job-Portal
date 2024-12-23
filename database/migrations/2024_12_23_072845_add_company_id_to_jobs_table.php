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
        Schema::table('jobs', function (Blueprint $table) {
            // Adding company_id column, assuming company IDs are integers
            $table->unsignedBigInteger('company_id');

            // Adding foreign key constraint (assuming companies table has an 'id' column)
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Drop the company_id column and foreign key constraint
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
};
