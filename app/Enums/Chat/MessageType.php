<?php

namespace App\Enums\Chat;

enum MessageType
{
    case message;
    case notification;
    case new_chat;
    case file;
}
