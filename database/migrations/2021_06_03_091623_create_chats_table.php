<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->longText('messages');
            $table->timestamps();
        });

        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id',)->constrained('users', 'id')->onDeleted('cascade')->onUpdated('cascade');
            $table->foreignId('reciever_id',)->constrained('users', 'id')->onDeleted('cascade')->onUpdated('cascade');
            $table->foreignId('message_id',)->constrained('messages', 'id')->onDeleted('cascade')->onUpdated('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}