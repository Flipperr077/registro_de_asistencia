<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDays extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'comments',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'school_day_user', 'school_day_id', 'user_id');
    }
public function schoolDays(): BelongsToMany
{
    return $this->belongsToMany(SchoolDays::class, 'school_day_user');
}

    
    // Mutador para formatear la fecha al guardar
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? \Carbon\Carbon::parse($value) : null;
    }
}