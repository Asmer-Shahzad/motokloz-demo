<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLatLngFromUserInformationTable extends Migration
{
    public function up()
    {
        Schema::table('user_information', function (Blueprint $table) {
            $columns = ['latitude', 'longitude'];
            $existing = array_filter($columns, fn($col) => Schema::hasColumn('user_information', $col));
            if (!empty($existing)) {
                $table->dropColumn(array_values($existing));
            }
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
