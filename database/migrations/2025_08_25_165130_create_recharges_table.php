<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recharges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')
                  ->constrained('cards')
                  ->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('card_recharges');
    }
};
