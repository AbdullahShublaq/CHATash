<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReplyToPrivateRoomMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('private_room_messages', function (Blueprint $table) {
            $table->uuid('reply_to_id')->nullable()->after('user_id');
            $table->json('reply_to')->nullable()->after('reply_to_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('private_room_messages', function (Blueprint $table) {
            $table->dropColumn(['reply_to', 'reply_to_id']);
        });
    }
}