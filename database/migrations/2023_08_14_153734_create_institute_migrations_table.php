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
        Schema::create('institute_migrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained();
            $table->boolean('is_migrated')->default(0);
            $table->string('institute_name')->nullable();
            $table->string('leaving_certificate')->nullable();
            $table->string('other_document')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institute_migrations');
    }
};
