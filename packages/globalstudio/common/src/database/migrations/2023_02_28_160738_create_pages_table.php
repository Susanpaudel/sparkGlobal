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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->unique();
            $table->string('slug',100)->unique();
            $table->foreignId('added_by')->constrained('users');
            $table->longText('content')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('menu')->default(0);
            $table->longText('page_above')->nullable();
            $table->longText('page_below')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
