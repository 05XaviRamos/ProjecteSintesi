<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    /** @use HasFactory<\Database\Factories\RecordsFactory> */
    use HasFactory;

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function zones() {
        return $this->belongsTo(Zones::class);
    }

    public function containers() {
        return $this->belongsTo(Containers::class);
    }

    public function materials() {
        return $this->belongsTo(Materials::class);
    }
}