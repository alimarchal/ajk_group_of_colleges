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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            //user id for that generate voucher
            $table->foreignId('challan_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('student_id')->nullable()->constrained();

            $table->foreignId('fee_type_id')->nullable()->constrained();
            $table->foreignId('institute_class_id')->nullable()->constrained();
            $table->foreignId('section_id')->nullable()->constrained();
            $table->foreignId('institute_session_id')->nullable()->constrained();


            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();

            $table->boolean('is_discounted')->default(0);
            $table->enum('discount_type', ['Flat', 'Percentage', 'No-Discount'])->default('No-Discount');
            $table->decimal('discounted_number', 14, 2)->default(0.00);

            $table->decimal('amount', 14, 2)->nullable();
            // if the fee is late submitted
            $table->decimal('fine', 14, 2)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('challan_uploaded_id')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('challan_path')->nullable();
            $table->enum('status', ['Paid', 'UnPaid', 'Canceled'])->default('UnPaid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
