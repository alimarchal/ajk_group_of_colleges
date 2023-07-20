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
        Schema::create('fee_types', function (Blueprint $table) {

            /*
                name: The name of the fee type, such as "Tuition Fee," "Transportation Fee," "Library Fee," etc.
                description: A brief description of the fee type to provide additional information.
                amount: The amount of the fee.
                is_recurring: A boolean field indicating whether the fee is a recurring fee (e.g., monthly, quarterly) or a one-time fee.
                frequency: If is_recurring is true, this field can store the frequency of the fee (e.g., "Monthly," "Quarterly," "Annually").
             */
            $table->id();
            $table->foreignId('fee_category_id')->nullable()->constrained();
            $table->text('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->boolean('is_recurring')->default(false);
            $table->string('frequency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_types');
    }
};
