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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('description')->nullable();
            $table->text('employee_type')->nullable();
            $table->string('qualification', 191)->nullable();
            $table->string('passion')->nullable();
            $table->string('achivement')->nullable();
            $table->string('mobile', 16)->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('google')->nullable();
            $table->string('twitter')->nullable();
            $table->foreignId('added_by')->constrained('users');
            $table->boolean('status')->default(1);
            $table->boolean('is_top')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
