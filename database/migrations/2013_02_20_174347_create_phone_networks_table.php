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
        Schema::create('phone_networks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });


        DB::transaction(function () {
            $query = "
                    INSERT INTO `phone_networks` (`name`, `created_at`, `updated_at`) VALUES
                        ('Mobilink Jazz', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Telenor', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('UFone', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Zong', '2023-03-02 03:35:01', '2023-03-02 03:35:01'),
                        ('Warid', '2023-03-02 03:35:01', '2023-03-02 03:35:01');
                ";
            DB::statement($query);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_networks');
    }
};
