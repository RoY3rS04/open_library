<?php

namespace App\Enums;

enum NotificationType: int
{
    case Success = 1;
    case Error = 2;
    case Information = 3;
}
