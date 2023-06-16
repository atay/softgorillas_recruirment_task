<?php

namespace App\Application\Event;

use App\Domain\Event\Model\InputEvent;
use App\Domain\Exception\MissingDescriptionException;
use App\Domain\Exception\MissingNumberException;

class InputEventFactory implements InputEventFactoryInterface
{
    public function createEvent(array $eventSource): InputEvent
    {
        if (!isset($eventSource['number'])) {
            throw new MissingNumberException;
        }

        if (!isset($eventSource['description'])) {
            throw new MissingDescriptionException;
        }

        return new InputEvent(
            $eventSource['number'],
            $eventSource['description'],
            $eventSource['dueDate'] ?? null,
            $eventSource['phone'] ?? null
        );
    }
}