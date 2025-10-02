<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rides', function (Blueprint $table) {
            if (!Schema::hasColumn('rides', 'ticket_type_id')) {
                $table->foreignId('ticket_type_id')
                      ->after('transport_id')
                      ->constrained()
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rides', function (Blueprint $table) {
            if (Schema::hasColumn('rides', 'ticket_type_id')) {
                $table->dropForeign(['ticket_type_id']);
                $table->dropColumn('ticket_type_id');
            }
        });
    }
};
