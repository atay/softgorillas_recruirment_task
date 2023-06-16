<?php

namespace App\Domain\Event\Enum;

enum Priority: string
{
    case CRITICAL = 'critical';
    case HIGH = 'high';
    case NORMAL = 'normal';
}