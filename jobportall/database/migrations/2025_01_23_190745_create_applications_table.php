<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id'); // Foreign key reference to jobs table
            $table->unsignedBigInteger('user_id'); // Foreign key reference to users table
            $table->text('cover_letter')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Set engine to InnoDB
        DB::statement('ALTER TABLE applications ENGINE = InnoDB');
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
