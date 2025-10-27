<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ticket_types', function (Blueprint $table) {
            if (! Schema::hasColumn('ticket_types', 'city_id')) {
                $table->foreignId('city_id')
                    ->after('price')
                    ->constrained()           
                    ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('ticket_types', function (Blueprint $table) {
            if (Schema::hasColumn('ticket_types', 'city_id')) {
                $table->dropConstrainedForeignId('city_id'); 
            }
        });
    }
};
