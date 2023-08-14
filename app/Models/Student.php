<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_no',
        'roll_no',
        'institute_class_id',
        'section_id',
        'category_id',
        'firstname',
        'lastname',
        'gender',
        'dob',
        'religion',
        'cast',
        'mobile_no',
        'email',
        'admission_date',
        'blood_group_id',
        'house',
        'height',
        'weight',
        'measure_date',
        'fees_discount',
        'medical_history',
        'student_pic',
    ];


    public function guardian(): HasOne
    {
        return $this->hasOne(Guardian::class);
    }

    public function emergencyContact(): HasOne
    {
        return $this->hasOne(StudentGurdianAlertContact::class);
    }

    public function instituteClass(): BelongsTo
    {
        return $this->belongsTo(InstituteClass::class);
    }

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }


    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function instituteMigratedStudent()
    {
        return $this->hasOne(InstituteMigration::class, 'student_id');
    }
}
