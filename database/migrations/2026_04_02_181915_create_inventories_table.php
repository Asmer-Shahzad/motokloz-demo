<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            // Car Details
            $table->string('title')->nullable();
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->string('condition')->nullable();
            $table->string('stock_number')->nullable();
            $table->string('mileage')->nullable();
            $table->string('transmission')->nullable();
            $table->text('description')->nullable();

            // Features (JSON)
            $table->json('features')->nullable();

            // Pricing
            $table->string('price')->nullable();

            // Images (JSON for multiple images)
            $table->json('images')->nullable();

            $table->timestamps();
        });

        Schema::create('inventory_extra_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained('inventories')->onDelete('cascade');
            $table->string('title');
            $table->string('price'); // ya decimal agar chaho
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
        Schema::dropIfExists('inventory_extra_services');
    }
}
