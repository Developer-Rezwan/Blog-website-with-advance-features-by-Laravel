<?php

namespace App\Http\Controllers\Backend;

use App\Events\ChattingEvent;
use App\Events\TypingEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageNotification;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($id)
    {
        \broadcast(new TypingEvent($id, \auth()->user()->id));
        $this->data['users'] = User::select('id', 'fullName', 'photo')->whereKeyNot(auth()->user()->id)->get();
        $this->data['reciever'] = User::findOrNew($id);

        return \view('backend.chat.index', $this->backend, $this->data);
    }

    public function fetchMessages($sender, $reciever)
    {
        $chatter = Chat::select()
            ->with('message', 'sender', 'reciever')
            ->where('sender_id', $sender)
            ->where('reciever_id', $reciever)
            ->orWhere('sender_id', $reciever)
            ->where('reciever_id', $sender)
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($chatter, 200);
    }

    public function processData(Request $request)
    {
        $message = Message::create($request->only('messages'));

        $this->data['sender_id']    = auth()->user()->id;
        $this->data['reciever_id']  = $request->reciever_id;
        $this->data['message_id']   = $message->id;

        $chat = Chat::create($this->data);
        broadcast(new ChattingEvent($chat->load('sender', 'reciever', 'message')));

        $reciever = User::findOrFail($request->reciever_id);
        $reciever->notify(new MessageNotification($chat));

        return response()->json($chat->load('sender', 'reciever', 'message'), 200);
    }

    public function fetchLastMessage($sender, $reciever)
    {
        $chatter = Chat::select()
            ->with('message', 'sender', 'reciever')
            ->where('sender_id', $sender)
            ->where('reciever_id', $reciever)
            ->orWhere('sender_id', $reciever)
            ->where('reciever_id', $sender)
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($chatter, 200);
    }
}