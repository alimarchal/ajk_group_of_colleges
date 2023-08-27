<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeeTypeCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'user_id',
        'fee_type_id',
        'institute_class_id',
        'section_id',
        'issue_date',
        'due_date',
        'is_discounted',
        'discount_type',
        'discounted_number',
        'amount',
        'fine',
        'status',
    ];


    public function feeType(): BelongsTo
    {
        return $this->belongsTo(FeeType::class);
    }

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
