<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    /** @use HasFactory<\Database\Factories\RecordsFactory> */
    use HasFactory;

    protected $fillable = ['zone_id', 'container_id', 'material_id', 'weight', 'movement'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function zone() {
        return $this->belongsTo(Zones::class);
    }

    public function container() {
        return $this->belongsTo(Containers::class);
    }

    public function material() {
        return $this->belongsTo(Materials::class);
    }
}