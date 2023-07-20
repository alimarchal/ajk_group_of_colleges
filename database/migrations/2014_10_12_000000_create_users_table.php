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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained();
            $table->foreignId('blood_group_id')->nullable()->constrained();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile')->nullable();
            $table->foreignId('phone_network_id')->nullable()->constrained();
            $table->string('telephone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
