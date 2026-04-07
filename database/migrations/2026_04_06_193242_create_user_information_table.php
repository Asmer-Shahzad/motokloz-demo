<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('personal_website')->nullable();
            $table->text('bio')->nullable();
            $table->string('languages')->nullable();
            $table->string('nationality')->nullable();
            $table->string('avatar')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->text('complete_address')->nullable();
            $table->string('find_on_map')->nullable();
            // latitude, longitude removed — using Google Maps embed instead
            $table->string('postalCode')->nullable();
            $table->timestamps();
            
            // ✅ Foreign key constraint
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_information');
    }
}
