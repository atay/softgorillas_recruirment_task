<?php

namespace App\Domain\Event\Strategy;

use App\Domain\Event\Enum\EventType;
use App\Domain\Event\Model\InputEvent;

interface EventRecognizeStrategyInterface
{
    public function getEventType(InputEvent $event): EventType;

}