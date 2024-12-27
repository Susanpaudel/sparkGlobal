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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->text('title',100)->nullable();
            $table->text('sub_title',100)->nullable();
            $table->text('body')->nullable(); 
            $table->string('image')->nullable();
            $table->string('button_one_title',50)->nullable();
            $table->text('button_one_url')->nullable();
            $table->string('button_two_title',50)->nullable();
            $table->text('button_two_url')->nullable();
            $table->foreignId('added_by')->constrained('users');
            $table->boolean('status')->default(1);
            $table->integer('priority')->nullable()->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
