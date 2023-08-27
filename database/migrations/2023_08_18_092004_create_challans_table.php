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
        Schema::create('challans', function (Blueprint $table) {
            $table->id()->startingValue(100000);
            $table->foreignId('student_id')->nullable()->constrained();
            $table->date('payment_date')->nullable();
            $table->decimal('payment_amount',14,2)->nullable();
            $table->string('payment_scanned_path')->nullable();
            $table->enum('status',['Paid','UnPaid','Canceled'])->default('UnPaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challans');
    }
};
