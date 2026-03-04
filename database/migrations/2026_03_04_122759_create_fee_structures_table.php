<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeStructuresTable extends Migration
{
    public function up()
    {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->enum('fee_type', ['admission', 'monthly', 'exam', 'other']);
            $table->decimal('amount', 10, 2);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->unique(['course_id', 'fee_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('fee_structures');
    }
}
