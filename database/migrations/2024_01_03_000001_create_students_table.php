<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no')->unique();
            $table->date('registration_date');
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null');
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('set null');
            $table->foreignId('batch_id')->nullable()->constrained('batches')->onDelete('set null');
            // Personal
            $table->string('student_name');
            $table->string('father_name');
            $table->string('father_designation')->nullable();
            $table->string('mother_name');
            $table->string('mother_designation')->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other'])->default('male');

            // Address
            $table->text('permanent_address');
            $table->string('city')->nullable();
            $table->string('pincode', 10)->nullable();

            // Contact
            $table->string('student_phone', 15);
            $table->string('student_whatsapp', 15)->nullable();
            $table->string('father_phone', 15)->nullable();
            $table->string('mother_phone', 15)->nullable();
            $table->string('email')->nullable();

            // Photo
            $table->string('photo')->nullable();

            // Status
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->boolean('is_locked')->default(false);
            $table->string('lock_reason')->nullable();

            // Meta
            $table->unsignedBigInteger('added_by')->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
