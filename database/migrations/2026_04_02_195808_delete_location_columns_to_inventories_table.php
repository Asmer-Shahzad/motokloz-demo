<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteLocationColumnsToInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Drop location columns (only if they exist — safe for fresh migrations)
            $columns = ['country', 'state', 'city', 'address', 'address2', 'extra_services'];
            $existing = array_filter($columns, fn($col) => Schema::hasColumn('inventories', $col));
            if (!empty($existing)) {
                $table->dropColumn(array_values($existing));
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Restore columns if rollback
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();

            $table->json('extra_services')->nullable();
        });
    }
}
