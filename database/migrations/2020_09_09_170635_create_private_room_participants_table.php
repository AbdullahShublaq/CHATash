<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateRoomParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_room_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('private_room_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('private_room_id')->references('id')->on('private_rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('private_room_participants');
    }
}
