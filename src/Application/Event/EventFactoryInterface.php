<?php

namespace App\Application\Event;

use App\Domain\Events\Event;

interface EventFactoryInterface
{
    public function createEvent(array $eventSource): Event;
}