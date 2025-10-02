<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('top_up_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->timestamp('recharged_at')->default(now());
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('top_up_histories');
    }
};
