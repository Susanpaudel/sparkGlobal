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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->unique();
            $table->string('slug',100)->unique();
            $table->string('image', 150)->nullable();
            $table->longText('content')->nullable();
            $table->string('enrolled')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('featured');
            $table->integer('views')->default(0)->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
