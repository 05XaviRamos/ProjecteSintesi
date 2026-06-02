<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model de materials.
 */
class Materials extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialsFactory> */
    use HasFactory;

    protected $fillable = ['name', 'input', 'output'];

    /**
     * Registres que usen aquest material.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function records()
    {
        return $this->hasMany(Records::class);
    }

    /**
     * Zones on es pot fer servir el material.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function zones()
    {
        return $this->belongsToMany(Zones::class, 'zones__materials', 'material_id', 'zone_id');
    }
}
