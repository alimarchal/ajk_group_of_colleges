<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstituteMigration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'is_migrated',
        'institute_name',
        'leaving_certificate',
        'other_document',
        'remarks',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
