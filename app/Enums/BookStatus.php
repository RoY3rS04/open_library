<?php

namespace App\Enums;

enum BookStatus: string {
    case Processing = 'Processing';
    case Draft = 'draft';
    case Pending = 'pending';
    case Rejected = 'rejected';
    case Approved = 'approved';
}
