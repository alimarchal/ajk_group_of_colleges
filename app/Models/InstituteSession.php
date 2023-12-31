<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_start_year',
        'session_end_year',
        'session_year',
    ];
}
