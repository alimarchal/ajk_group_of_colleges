<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InstituteClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'active',
    ];


    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }
}
