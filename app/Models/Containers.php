<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Containers extends Model
{
    /** @use HasFactory<\Database\Factories\ContainersFactory> */
    use HasFactory;

    protected $fillable = ['name', 'weight', 'input', 'output'];

    public function records() {
        return $this->hasMany(Records::class);
    }

    public function zones() {
        return $this->belongsToMany(Zones::class);
    }
}