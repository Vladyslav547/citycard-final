<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_type_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('transport_type_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->timestamps();

            $table->unique(['ticket_type_id', 'transport_type_id'], 'ticket_type_transport_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_type_prices');
    }
};
