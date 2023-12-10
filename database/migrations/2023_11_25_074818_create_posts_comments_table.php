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
        Schema::create('posts_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->foreignId('posts_id');
            $table->text('description');
            $table->timestamps();
        });
        Schema::table('posts_comments', function (Blueprint $table) {
            $table->index('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('posts_id');
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_comments');
    }
};
