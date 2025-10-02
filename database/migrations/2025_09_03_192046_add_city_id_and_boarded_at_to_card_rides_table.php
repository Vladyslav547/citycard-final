<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::table('card_rides', function (Blueprint $table) {
        if (!Schema::hasColumn('card_rides', 'boarded_at')) {
            $table->timestamp('boarded_at')->nullable()->after('price');
        }
    });
}

    public function down(): void
{
    Schema::table('card_rides', function (Blueprint $table) {
        $table->dropColumn(['boarded_at']);
    });
}

};
