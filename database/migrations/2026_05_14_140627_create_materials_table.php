<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la taula de materials.
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->boolean("input");
            $table->boolean("output");
            $table->timestamps();
        });
    }

    /**
     * Elimina la taula de materials.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
