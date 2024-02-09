<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeachingSubject extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'subject_id', 'institute_class_id', 'section_id'];
}
