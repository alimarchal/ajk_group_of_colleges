<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'challan_id',
        'user_id',
        'student_id',
        'fee_type_id',
        'institute_class_id',
        'section_id',
        'issue_date',
        'due_date',
        'amount',
        'fine',
        'payment_date',
        'challan_uploaded_id',
        'bank_id',
        'challan_path',
        'status',
        'is_discounted',
        'discount_type',
        'discounted_number',
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


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function challan(): BelongsTo
    {
        return $this->belongsTo(Challan::class);
    }
}
