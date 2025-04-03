<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * This includes the Solis API ID and key
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'solis_api_id', 'solis_api_key' => 'hashed'
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
     * Create relationship to Users
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Create relationship to Installations
     */
    public function installations(): HasMany
    {
        return $this->hasMany(Installation::class);
    }
}
