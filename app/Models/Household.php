<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model representing a household. 
 * 
 * Households contain contact information and optionally API information for interfacing with the SolisCloud API.
 * Households have multiple users and installations assigned to them.
 */
class Household extends Model
{
    /**
     * Attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'street',
        'number',
        'postcode',
        'city',
        'country',
        'solis_api_id',
        'solis_api_key'
    ];

    /**
     * Attributes that should be cast to certain types.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            
        ];
    }

    /**
     * Attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'solis_api_id',
        'solis_api_key',
    ];


    /**
     * Create relationship to users
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Create relationship to installations
     */
    public function installations(): HasMany
    {
        return $this->hasMany(Installation::class);
    }
}
