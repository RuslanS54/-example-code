<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('text');
            $table->string('image', 1024)->nullable();
            $table->string('slug', 255);
            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('time_reading')->default(0);
            $table->unsignedInteger('view')->default(0);
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table){
            $table->dropForeign('user-id');
        });
        Schema::dropIfExists('posts');
    }
};
