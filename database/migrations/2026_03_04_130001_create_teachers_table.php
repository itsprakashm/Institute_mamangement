<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('qualification')->nullable();
            $table->unsignedInteger('experience')->default(0)->comment('Experience in years');
            $table->timestamps();
        });

        if (Schema::hasTable('batches') && Schema::hasColumn('batches', 'teacher_id')) {
            Schema::table('batches', function (Blueprint $table) {
                $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('batches') && Schema::hasColumn('batches', 'teacher_id')) {
            Schema::table('batches', function (Blueprint $table) {
                $table->dropForeign(['teacher_id']);
            });
        }

        Schema::dropIfExists('teachers');
    }
}
