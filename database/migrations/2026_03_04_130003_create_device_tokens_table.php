<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTokensTable extends Migration
{
    public function up()
    {
        Schema::create('device_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('device_token')->unique();
            $table->enum('platform', ['android', 'ios', 'web'])->default('android');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('device_tokens');
    }
}
