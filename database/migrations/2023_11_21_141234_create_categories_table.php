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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('users_id');
            $table->foreignId('types_id');
            $table->timestamps();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->index('types_id');
            $table->foreign('types_id')->references('id')->on('types')->onDelete('cascade');
            $table->index('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
