<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeyVersionToPublicRoomMessagesTable extends Migration
{
    public function up(): void
    {
        Schema::table('public_room_messages', function (Blueprint $table) {
            $table->unsignedSmallInteger('key_version')->default(1)->after('reply_to');
        });
    }

    public function down(): void
    {
        Schema::table('public_room_messages', function (Blueprint $table) {
            $table->dropColumn('key_version');
        });
    }
}