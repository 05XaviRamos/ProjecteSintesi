<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model de zones.
 */
class Zones extends Model
{
    /** @use HasFactory<\Database\Factories\ZonesFactory> */
    use HasFactory;

    protected $table = 'zones';

    protected $fillable = ['name'];

    /**
     * Registres relacionats amb la zona.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function records()
    {
        return $this->hasMany(Records::class);
    }

    /**
     * Materials associats a la zona.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function materials()
    {
        return $this->belongsToMany(Materials::class, 'zones__materials', 'zone_id', 'material_id');
    }

    /**
     * Contenidors associats a la zona.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function containers()
    {
        return $this->belongsToMany(Containers::class, 'zones__containers', 'zone_id', 'container_id');
    }
}
