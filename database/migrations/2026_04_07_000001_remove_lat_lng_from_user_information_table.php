<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLatLngFromUserInformationTable extends Migration
{
    public function up()
    {
        Schema::table('user_information', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }

    public function down()
    {
        Schema::table('user_information', function (Blueprint $table) {
            $table->string('find_on_map')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
    }
}
