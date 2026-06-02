<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model dels registres.
 */
class Records extends Model
{
    /** @use HasFactory<\Database\Factories\RecordsFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'zone_id', 'container_id', 'material_id', 'weight', 'wight', 'movement'];

    /**
     * Desa el pes al camp intern correcte.
     *
     * @param mixed $value
     * @return void
     */
    public function setWeightAttribute($value): void
    {
        $this->attributes['wight'] = $value;
    }

    /**
     * Llegeix el pes guardat.
     *
     * @return mixed
     */
    public function getWeightAttribute(): mixed
    {
        return $this->attributes['wight'] ?? null;
    }

    /**
     * Usuari que ha creat el registre.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Zona del registre.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zones::class);
    }

    /**
     * Contenidor del registre.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function container()
    {
        return $this->belongsTo(Containers::class);
    }

    /**
     * Material del registre.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo(Materials::class);
    }
}
