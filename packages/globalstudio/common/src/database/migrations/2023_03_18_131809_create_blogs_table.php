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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->foreignId('added_by')->constrained('users');
            $table->longText('content')->nullable();
            $table->longText('short_content')->nullable();
            $table->string('image', 150)->nullable();
            $table->string('tags')->nullable();
            $table->string('seo_title')->nullable();
            $table->integer('views')->default(0);
            $table->string('seo_keyword')->nullable();
            $table->string('seo_description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
