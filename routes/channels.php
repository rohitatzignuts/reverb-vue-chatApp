<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('reverb-chat-app', function ($user) {
    return true;
});
