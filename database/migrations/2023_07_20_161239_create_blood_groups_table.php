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
        Schema::create('blood_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });



        DB::transaction(function () {
            $query = "
                    INSERT INTO `blood_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
                    (1, 'A Positive (A+)', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                    (2, 'A Negative (A-)', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                    (3, 'B Positive (B+)', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                    (4, 'B Negative (B-)', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                    (5, 'O Positive (O+)', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                    (6, 'O Negative (O-)', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                    (7, 'AB Positive (AB+)', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                    (8, 'AB Negative (AB-)', '2023-03-02 03:35:01', '2023-03-02 03:35:01');
                ";

            DB::statement($query);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_groups');
    }
};
