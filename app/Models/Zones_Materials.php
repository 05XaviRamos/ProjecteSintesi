<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Taula pivot de zones i materials.
 */
class Zones_Materials extends Model
{
    /** @use HasFactory<\Database\Factories\ZonesMaterialsFactory> */
    use HasFactory;
}
