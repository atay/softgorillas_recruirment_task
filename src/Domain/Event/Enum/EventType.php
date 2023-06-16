<?php

namespace App\Domain\Event\Enum;

enum EventType: string
{
    case INSPECTION = 'inspection';
    case FAILURE = 'failure';
}