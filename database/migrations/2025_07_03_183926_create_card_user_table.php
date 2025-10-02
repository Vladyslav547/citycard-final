<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('card_user', function (Blueprint $table) {
    $table->id();
    $table->foreignId('card_id')->constrained('cards')->cascadeOnDelete();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->timestamps();
});

    }

    public function down(): void {
        Schema::dropIfExists('cards');
    }
};
