<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Create relationship to Household
     * Every installation has to belong to a household
     */
    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }
}
