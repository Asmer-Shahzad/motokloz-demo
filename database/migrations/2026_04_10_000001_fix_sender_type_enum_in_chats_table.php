<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixSenderTypeEnumInChatsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('chats')) {
            DB::statement("ALTER TABLE chats MODIFY sender_type ENUM('client','dealer','guest') NULL");
        }
    }

    public function down()
    {
        DB::statement("ALTER TABLE chats MODIFY sender_type ENUM('guest','dealer') NULL");
    }
}
