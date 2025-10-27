<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();

            $table->foreignId('card_id')
                ->constrained()                
                ->cascadeOnDelete();

            $table->foreignId('city_id')
                ->constrained()                
                ->cascadeOnDelete();

            $table->foreignId('transport_id')
                ->constrained('transport_types')
                ->cascadeOnDelete();

            $table->timestamp('ride_time')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
