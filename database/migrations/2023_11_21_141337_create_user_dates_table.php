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
        Schema::create('user_dates', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('sum');
            $table->text('comment')->nullable();
            $table->foreignId('users_id');
            $table->foreignId('categories_id');
            $table->foreignId('types_id');
            $table->timestamps();
        });
        Schema::table('user_dates', function (Blueprint $table) {
            $table->index('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->index('types_id');
            $table->foreign('types_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dates');
    }
};
