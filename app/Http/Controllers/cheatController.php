<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheatController extends Controller
{
    public function sendmessage(Request $request)
    {
        $senderId = auth()->id();

        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required|exists:users,id',
            'message_content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $message = Message::create([
            'sender_id' => $senderId,
            'receiver_id' => $request->receiver_id,
            'message_content' => $request->message_content,
        ]);


        //broadcast(new  MessageSend($message));

        return response()->json([
            'status' => true,
            'message' => 'Message sent successfully',
        ]);
    }
}
