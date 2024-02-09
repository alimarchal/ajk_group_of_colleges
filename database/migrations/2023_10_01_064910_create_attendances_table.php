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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // teacher name is user_id
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('student_id')->nullable()->constrained();
            // Class and Section
            $table->foreignId('institute_class_id')->nullable()->constrained();
            $table->foreignId('section_id')->nullable()->constrained();
            $table->foreignId('institute_session_id')->nullable()->constrained();
            $table->timestamp('date')->useCurrent();
            $table->enum('status', ['present', 'absent', 'late','leave'])->default('absent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
