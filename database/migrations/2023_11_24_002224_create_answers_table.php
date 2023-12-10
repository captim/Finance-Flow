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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->foreignId('users_id');
            $table->foreignId('questions_id');
            $table->timestamps();
        });
        Schema::table('answers', function (Blueprint $table) {
            $table->index('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('questions_id');
            $table->foreign('questions_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
