<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la taula pivot de zones i contenidors.
     */
    public function up(): void
    {
        Schema::create('zones__containers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("zone_id");
            $table->foreignId("container_id");
            $table->timestamps();
        });
    }

    /**
     * Elimina la taula pivot de zones i contenidors.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones__containers');
    }
};
