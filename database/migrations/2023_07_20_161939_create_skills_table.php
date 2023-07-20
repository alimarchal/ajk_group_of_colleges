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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        DB::transaction(function () {
            $query = "
                    INSERT INTO `skills` (`name`, `created_at`, `updated_at`) VALUES
                        ('PUNCTUALITY', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('NEATNESS', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('HONESTY', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('RELIABILITY', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('RELATIONSHIP WITH OTHERS', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('POLITENESS', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('ALERTNESS', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('HANDWRITING', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('GAMES & SPORTS', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('DRAWING & ARTS', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('PAINTING', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('CONSTRUCTION', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('MUSICAL SKILLS', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('FLEXIBILITY', '2023-03-02 03:35:01', '2023-03-02 03:35:01');
                ";

            DB::statement($query);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
