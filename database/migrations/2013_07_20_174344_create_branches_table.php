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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('acronym')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });


        DB::transaction(function () {
            $query = "
                    INSERT INTO `branches` (`name`, `acronym`, `phone`, `email`, `city`, `address`, `status`, `created_at`, `updated_at`) VALUES
                    ('AJK GC Muzaffarabad Branch', 'AJKGCMC', '03008169924', 'alirazamarchal@hotmail.com', 'Muzaffarabad', 'Khawaja Mollah Ward # 16, Muzaffarabad, Azad Jammu & Kashmir', '1', '2023-03-02 03:35:01', '2023-03-02 03:35:01');
                ";
            DB::statement($query);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
