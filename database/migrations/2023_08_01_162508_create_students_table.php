<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no')->nullable();
            $table->string('roll_no')->nullable();
            $table->foreignId('institute_class_id')->nullable()->constrained();
            $table->foreignId('section_id')->nullable()->constrained();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('religion')->nullable();
            $table->string('cast')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->unique();
            $table->date('admission_date')->nullable();
            $table->foreignId('blood_group_id')->nullable()->constrained();
            $table->string('house')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->date('measure_date')->nullable();
            $table->integer('fees_discount')->default(0);
            $table->string('medical_history')->nullable();
            $table->string('student_pic')->nullable();
            $table->enum('status', ['In-Process', 'Approved', 'Rusticated','Leaved'])->default('In-Process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
