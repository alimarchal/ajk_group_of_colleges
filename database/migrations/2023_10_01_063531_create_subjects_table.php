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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('name')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::transaction(function () {
            $query = "
                INSERT INTO `subjects` (`id`, `user_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
                (1, NULL, 'Urdu', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (2, NULL, 'English', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (3, NULL, 'Physics', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (4, NULL, 'Mathematics', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (5, NULL, 'Computer Science', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (6, NULL, 'Biology', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (7, NULL, 'Islamic Studies', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (8, NULL, 'Arabic', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01')
            ";
            DB::statement($query);
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
