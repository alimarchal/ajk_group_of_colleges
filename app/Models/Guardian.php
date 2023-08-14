<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'father_name',
        'father_phone',
        'father_occupation',
        'father_pic',
        'mother_name',
        'mother_phone',
        'mother_occupation',
        'mother_pic',
        'guardian_is',
        'guardian_name',
        'guardian_relation',
        'guardian_phone',
        'guardian_occupation',
        'guardian_email',
        'guardian_pic',
        'guardian_address',
    ];
}
