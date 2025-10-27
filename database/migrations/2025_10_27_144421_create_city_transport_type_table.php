<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('city_transport_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('transport_type_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['city_id', 'transport_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('city_transport_type');
    }
};
