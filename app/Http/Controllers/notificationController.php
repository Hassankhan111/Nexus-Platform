<?php

namespace App\Http\Controllers;
use App\Models\investor_startup;
use App\Models\startup;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\Startupinvestor;
use Illuminate\Support\Facades\Validator;

class notificationController extends Controller
{
    public function sendmessage(Request $request)
    {
        $validator = validator::make($request->all(), [
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $receiver = User::find($request->receiver_id);

         $sender = auth()->user();
         $img = null;
         
         if($sender->role === 'investor'){
            $img = investor_startup::where('user_id', $sender->id)->value('inv_image'); 
         }

         if($sender->role === 'entrepreneur'){
            $img = startup::where('user_id', $sender->id)->value('image'); 
         }

        $receiver->notify(
            new Startupinvestor(
                $sender,
                $request->message,
                $img,

            )
        );

        return response()->json([
            'status' => true,
            'message' => $request->message,
        ], 200);
    }


    public function usernotification()
    {
        $user = auth()->user();
        $notification = $user->Notifications;
        //$read = $user->readNotifications;
        return response()->json([
            'status' => true,
            //'read' => $read,
            'notification' => $notification,
        ]);
    }


    public function markasread($id)
    {
        $user = auth()->user();
        $notification = $user->Notifications->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json([
            'status' => true,
        ]);

    }
}
