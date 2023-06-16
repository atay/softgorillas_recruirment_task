<?php

namespace App\Application\Event;

use App\Domain\Events\Event;
use App\Domain\Exceptions\InvalidEventException;

class EventFactory implements EventFactoryInterface
{
    public function createEvent(array $eventSource): Event
    {
        if (!isset($eventSource['number'])) {
            throw InvalidEventException::missingNumber();
        }

        if (!isset($eventSource['description'])) {
            throw InvalidEventException::missingDescription();
        }

        return new Event(
            $eventSource['number'],
            $eventSource['description'],
            $eventSource['dueDate'] ?? null,
            $eventSource['phone'] ?? null
        );
    }
}