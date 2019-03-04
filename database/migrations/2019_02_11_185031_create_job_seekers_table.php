<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status'); // status of jobSeeker in system [seeker job job , employed ,student]
            $table->text('bio')->nullable();  // Brief Biography
            $table->string('position')->nullable(); // current position if jobSeeker working or not
            $table->string('linked_in')->nullable(); // url of linkedIn if jobSeeker has
            $table->unsignedInteger('user_id'); // jobSeeker belong to one user in system
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('job_seekers');
    }
}
