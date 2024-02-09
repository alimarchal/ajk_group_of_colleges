<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'institute_class_id',
        'active',
    ];

    public function InstituteClass(): BelongsTo
    {
        return $this->belongsTo(InstituteClass::class);
    }
}
