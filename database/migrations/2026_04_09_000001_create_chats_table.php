<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('chats')) {
            Schema::create('chats', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('client_id');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('inventory_id');
                $table->text('message_body')->nullable();
                $table->enum('sender_type', ['client', 'dealer', 'guest'])->nullable();
                $table->boolean('is_read')->default(0);
                $table->boolean('is_delivered')->default(0);
                $table->timestamp('time')->nullable();
                $table->timestamps();

                $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
