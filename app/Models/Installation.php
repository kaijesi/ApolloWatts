<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model representing a PV installation.
 * 
 * Contains attributes about the installation, including its location, size and direction towards the sun.
 * Information contained describes the plant and is necessary for retrieving solar power output projections from the PVGIS API.
 * Each installation is realted to one household.
 */
class Installation extends Model
{
    /**
     * Attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'peak_power',
        'pv_tech',
        'system_loss',
        'slope_angle',
        'azimuth',
        'system_cost',
        'installer_name',
        'household_id'
    ];

    /**
     * Create relationship to household
     * Every installation has to belong to a household
     */
    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }
}
