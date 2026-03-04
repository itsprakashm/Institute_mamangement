<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBatchesTable extends Migration
{
    public function up()
    {
        Schema::create('student_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('batch_id')->constrained('batches')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['student_id', 'batch_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_batches');
    }
}
