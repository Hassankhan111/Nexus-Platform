<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('onlinechannel', function ($user) {
    // This data becomes the 'member' info in your JS
    return [
        'id' => $user->id,
        'name' => $user->name,
    ];


});


Broadcast::channel('broadcast-message.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
