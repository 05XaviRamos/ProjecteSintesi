<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la taula de registres.
     */
    public function up(): void
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("zone_id");
            $table->foreignId("container_id");
            $table->foreignId("material_id");
            $table->integer("weight");
            $table->enum("movement", ["entrada", "sortida"]);
            $table->timestamps();
        });
    }

    /**
     * Elimina la taula de registres.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
