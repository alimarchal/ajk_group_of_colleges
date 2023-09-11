<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;


class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'is_migrated',
        'institute_session_id',
        'student_pic',
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function challans(): HasMany
    {
        return $this->hasMany(Challan::class)->orderByDesc('created_at');
    }

    public function scopeAgeBetween(Builder $query, $minAge, $maxAge)
    {
        // Assuming your 'dob' field is the date of birth
        return $query->whereBetween('dob', [
            now()->subYears($maxAge),
            now()->subYears($minAge)->endOfDay()
        ]);
    }


    public function latestStatus(): HasOne
    {
        return $this->hasOne(Status::class)->latestOfMany();
    }


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

    public function fee_type_carts(): HasMany
    {
        return $this->hasMany(FeeTypeCart::class);
    }

    public function latestStudentSession(): HasOne
    {
        return $this->hasOne(StudentSession::class)->latestOfMany();
    }
}
