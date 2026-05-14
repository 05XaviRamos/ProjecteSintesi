<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialsFactory> */
    use HasFactory;

    public function records() {
        return $this->hasMany(Records::class);
    }

    public function zones() {
        return $this->belongsToMany(Zones::class);
    }
}

