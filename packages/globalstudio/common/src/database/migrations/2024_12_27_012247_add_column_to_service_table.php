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
        Schema::table('services', function (Blueprint $table) {
            $table->text('trader_choose_us_id')->nullable()->after('icon');
            $table->text('client_benefit_title')->nullable()->after('trader_choose_us_id');
            $table->text('client_benefit_description')->nullable()->after('client_benefit_title');
            $table->integer('status')->default(1)->after('client_benefit_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
           'trader_choose_us_id','client_benefit_title','client_benefit_description','status'
            ]);
        });
    }
};
