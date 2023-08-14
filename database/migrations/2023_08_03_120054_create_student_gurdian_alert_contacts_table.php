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
        Schema::create('student_gurdian_alert_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained();
            $table->string('home_number_emergency_contact')->nullable();
            $table->foreignId('phone_network_id')->nullable()->constrained();
            $table->string('mobile_number_for_sms_alert')->nullable();
            $table->string('email_address_for_school_report')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_gurdian_alert_contacts');
    }
};
