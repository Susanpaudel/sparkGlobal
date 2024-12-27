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
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',191)->unique();
            $table->string('mobile',16)->unique();
            $table->string('username',25)->unique();
            $table->string('image',150)->nullable();    
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role',['admin','customer']);
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('branch_id')->nullable()->constrained();
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();

        DB::table('users')->insert([
            'id' =>1,
            'name'     => 'Global Studio',
            'email'    => 'global@gmail.com',
            'password' => bcrypt('password'),
            'mobile'   => '98123131231',
            'username' => 'Global-Studio',
            'role'     => 'admin',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};