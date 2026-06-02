<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Taula pivot de zones i contenidors.
 */
class Zones_Containers extends Model
{
    /** @use HasFactory<\Database\Factories\ZonesContainersFactory> */
    use HasFactory;
}
