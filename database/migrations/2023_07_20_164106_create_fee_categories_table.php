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
        Schema::create('fee_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        DB::transaction(function () {
            $query = "
                    INSERT INTO `fee_categories` (`name`, `created_at`, `updated_at`) VALUES
                        ('Tuition Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Admission Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Examination Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Laboratory Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Library Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Transportation Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Sports Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Computer/IT Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Extracurricular Activity Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Security Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Development Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Maintenance Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Uniform Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Exam Paper Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Health/Medical Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Book Fee/Stationery Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Fine/Penalty Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Student Association Fee', '2023-03-02 03:35:01', '2023-03-02 03:35:01');
                ";

            DB::statement($query);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_categories');
    }
};
