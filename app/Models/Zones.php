<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Container;

class Zones extends Model
{
    /** @use HasFactory<\Database\Factories\ZonesFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function records() {
        return $this->hasMany(Records::class);
    }

    public function materials() {
        return $this->belongsToMany(Materials::class);
    }

    public function containers() {
        return $this->belongsToMany(Containers::class);
    }
}