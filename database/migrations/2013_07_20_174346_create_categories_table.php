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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });



        DB::transaction(function () {
            $query = "
                    INSERT INTO `categories` (`name`, `created_at`, `updated_at`) VALUES
                        ('General', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('OBC', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Special', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Physically', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Challenged', '2023-03-02 03:35:01', '2023-03-02 03:35:01');
                ";

            DB::statement($query);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
