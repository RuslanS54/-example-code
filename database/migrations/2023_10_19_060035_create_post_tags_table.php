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
        Schema::create('post_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->references('id')->on('tags')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('post_id')->references('id')->on('posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table){
            $table->dropForeign('tag_id');
            $table->dropForeign('post_id');
        });
        Schema::dropIfExists('post_tags');
    }
};
