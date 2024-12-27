<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*    * Run the migrations.
     */
    public function up(): void
    {
        // Schema::disableForeignKeyConstraints();

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->integer('priority')->default(100);
            $table->longText('short_content')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->text('icon')->nullable();
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
        Schema::dropIfExists('services');
    }
};
