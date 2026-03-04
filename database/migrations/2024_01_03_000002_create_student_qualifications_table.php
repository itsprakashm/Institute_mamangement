<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentQualificationsTable extends Migration
{
    public function up()
    {
        Schema::create('student_qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('degree');           // 10th, 12th, Graduation, Others
            $table->string('stream')->nullable();
            $table->string('board')->nullable();
            $table->string('passing_year', 10)->nullable();
            $table->string('marks_percentage', 10)->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_qualifications');
    }
}
