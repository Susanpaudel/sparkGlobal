<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_config', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->longText('value')->nullable();
            $table->string('data_type', 15)->nullable();
            $table->timestamps();
        });

        DB::table('site_config')->insert([
            'key'     => 'header_site_logo',
            'value'    => '',
            'data_type' => 'file',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'header_hours',
            'value'    => 'Mon - Sat 9.00 - 18.00',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'fav_icon',
            'value'    => '',
            'data_type' => 'file',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'header_text',
            'value'    => 'Visa & Immigration Consultants',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'mobile_number',
            'value'    => '+ 18000-200-1234',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'footer_mobile_1',
            'value'    => 'Australia: 1234 567 890',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'footer_mobile_2',
            'value'    => 'Ontario: 1234 567 890',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'address',
            'value'    => 'Visa Consultants, Tupac Amaru 200, USA',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'mail',
            'value'    => 'sales@globalstudio.com.np',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'facebook',
            'value'    => '',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'founded',
            'value'    => 'Founded In 1996 New York,USA',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'twitter',
            'value'    => '',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'instagram',
            'value'    => '',
            'data_type' => 'text',
        ]);

        DB::table('site_config')->insert([
            'key'     => 'linkedin',
            'value'    => '',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'google',
            'value'    => '',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'footer_about_us',
            'value'    => 'The Most Eminent Visas and Immigration Consultant service provider in major metros and overseas with reliability since 1994. We are committed to provide reliable client support.',
            'data_type' => 'textarea',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'map',
            'value'    => '',
            'data_type' => 'text',
        ]);
        DB::table('site_config')->insert([
            'key'     => 'footer_copyright',
            'value'    => '2020 Tripzia. All rights reserved.',
            'data_type' => 'textarea',
        ]);
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_config');
    }
};
