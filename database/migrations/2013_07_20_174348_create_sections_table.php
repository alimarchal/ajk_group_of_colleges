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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('institute_class_id')->nullable()->constrained();
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        // Inserting data into the 'sections' table
        DB::transaction(function () {
            $query = "
                INSERT INTO `sections` (`id`, `name`, `institute_class_id`, `active`, `created_at`, `updated_at`) VALUES
                (1, 'A', 1, 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (2, 'A', 2, 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (3, 'A', 3, 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                (4, 'A', 4, 1, '2023-03-02 03:35:01', '2023-03-02 03:35:01');
            ";
            DB::statement($query);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
