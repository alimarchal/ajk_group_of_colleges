<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeeType extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_category_id',
        'institute_class_id',
        'section_id',
        'description',
        'amount',
        'is_recurring',
        'frequency',
        'status',
    ];

    public function feeCategory(): BelongsTo
    {
        return $this->belongsTo(FeeCategory::class);
    }

    public function instituteClass(): BelongsTo
    {
        return $this->belongsTo(InstituteClass::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
