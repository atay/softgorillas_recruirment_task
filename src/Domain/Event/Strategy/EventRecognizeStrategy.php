<?php

namespace App\Domain\Event\Strategy;

use App\Domain\Event\Enum\EventType;
use App\Domain\Event\Model\InputEvent;

class EventRecognizeStrategy implements EventRecognizeStrategyInterface
{

    const INSPECTION_TEXT = "przegląd";

    public function getEventType(InputEvent $event): EventType
    {
        if (strpos($event->getDescription(), self::INSPECTION_TEXT) !== false) {
            return EventType::INSPECTION;
        }
        return EventType::FAILURE;
    }
}