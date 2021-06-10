<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chatting.channel.{id}', function ($user, $id) {
    if ((int) $user->id === (int) $id) {
        return $user;
    }
});

Broadcast::channel('active.user.checker', function ($user) {
    return $user;
});

Broadcast::channel('typer.finder.{id}', function ($user) {
    return $user;
});