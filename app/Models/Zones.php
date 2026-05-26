<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zones extends Model
{
    /** @use HasFactory<\Database\Factories\ZonesFactory> */
    use HasFactory;

    protected $table = 'zones';

    protected $fillable = ['name'];

    public function records() {
        return $this->hasMany(Records::class);
    }

    public function materials() {
        return $this->belongsToMany(Materials::class, 'zones__materials', 'zone_id', 'material_id');
    }

    public function containers() {
        return $this->belongsToMany(Containers::class, 'zones__containers', 'zone_id', 'container_id');
    }
}
