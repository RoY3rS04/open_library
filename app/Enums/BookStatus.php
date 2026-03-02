<?php

namespace App\Enums;

enum BookStatus: string {
    case Draft = 'draft';
    case Rejected = 'rejected';
    case Approved = 'approved';
}
