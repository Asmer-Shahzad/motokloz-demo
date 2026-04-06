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
            // Drop location columns
            $table->dropColumn(['country', 'state', 'city', 'address', 'address2']);

            // Drop extra_services JSON column
            $table->dropColumn('extra_services');
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
