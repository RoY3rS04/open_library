<?php

namespace App\Enums;

enum BookStatus: string {
    case Draft = 'draft';
    case Pending = 'pending';
    case Rejected = 'rejected';
    case Approved = 'approved';
}
