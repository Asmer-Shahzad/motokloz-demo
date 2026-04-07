<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFindonmapInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('user_information', function (Blueprint $table) {
        $table->string('find_on_map')->nullable();
    });
}

    /** SQLSTATE[42S22]: Column not found: 1054 Unknown column 'find_on_map' in 'field list' (SQL: update `user_information` set `country` = Sunt ut iusto labor, `city` = Proident quasi exce, `complete_address` = Ut qui facilis quod, `postalCode` = Ad commodo reprehend, `find_on_map` = In incididunt cupida, `user_information`.`updated_at` = 2026-04-06 23:20:18 where `id` = 2)
     * Reverse the migrations.
     *
     * @return void
     */
 public function down()
{
    Schema::table('user_information', function (Blueprint $table) {
        $table->dropColumn('find_on_map');
    });
}
}
