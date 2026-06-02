<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la taula de zones.
     */
    public function up(): void
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });
    }

    /**
     * Elimina la taula de zones.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};
