<?php

namespace App\Enums;

enum BookStatus: string {
    case Draft = 'draft';
    case Pending = 'pending';
    case Rejected = 'rejected';
    case Approved = 'approved';

    public function getIcon(): string {
        return \Blade::render('<x-icons.' . $this->value . '/>');
    }

    public function getColor(): string {
        return match ($this) {
            self::Draft => 'text-gray-400',
            self::Pending => 'text-yellow-400',
            self::Rejected => 'text-red-400',
            self::Approved => 'text-green-800',
        };
    }

    public function getBgColor(): string {
        return match ($this) {
            self::Draft => 'bg-gray-100 border-gray-200 border',
            self::Pending => 'bg-yellow-100 border-yellow-200 border',
            self::Rejected => 'bg-red-100 border-red-200 border',
            self::Approved => 'bg-green-100 border-green-200 border',
        };
    }
}
