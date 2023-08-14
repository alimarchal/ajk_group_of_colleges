<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGurdianAlertContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'home_number_emergency_contact',
        'phone_network_id',
        'mobile_number_for_sms_alert',
        'email_address_for_school_report',
    ];
}
