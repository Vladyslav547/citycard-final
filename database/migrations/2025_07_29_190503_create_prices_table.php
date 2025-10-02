<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->foreignId('transport_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 8, 2);
            $table->timestamps();

            $table->unique(['city_id', 'transport_id', 'ticket_type_id'], 'price_unique');
        });
    }

    public function down(): void {
        Schema::dropIfExists('prices');
    }
};
