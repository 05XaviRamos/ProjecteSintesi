<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model de contenidors.
 */
class Containers extends Model
{
    /** @use HasFactory<\Database\Factories\ContainersFactory> */
    use HasFactory;

    protected $fillable = ['name', 'weight', 'input', 'output'];

    /**
     * Registres relacionats amb el contenidor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function records()
    {
        return $this->hasMany(Records::class);
    }

    /**
     * Zones on es pot usar el contenidor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function zones()
    {
        return $this->belongsToMany(Zones::class, 'zones__containers', 'container_id', 'zone_id');
    }
}
