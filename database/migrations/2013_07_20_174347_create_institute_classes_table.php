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
        Schema::create('institute_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        DB::transaction(function () {
            $query = "
                INSERT INTO `institute_classes` (`id`, `name`, `code`, `active`, `created_at`, `updated_at`) VALUES
                (1, '9th Class', '9th', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (2, '10th Class', '10th', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (3, '1st Year', '11th', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (4, '2nd Year', '12th', 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01');
            ";
            DB::statement($query);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institute_classes');
    }
};
