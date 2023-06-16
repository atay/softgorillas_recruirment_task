<?php

namespace App\Application\Event;

use App\Domain\Event\Model\InputEvent;

interface InputEventFactoryInterface
{
    public function createEvent(array $eventSource): InputEvent;
}