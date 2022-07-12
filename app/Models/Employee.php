<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'date_of_birth',
        'address',
        'city',
        'country',
        'postal_code',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * @return HasMany
     */
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
