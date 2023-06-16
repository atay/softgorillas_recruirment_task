<?php

namespace App\Domain\Event\Factory;

use App\Domain\Event\Enum\Priority;
use App\Domain\Event\Enum\Status;
use App\Domain\Event\Model\InputEvent;
use App\Domain\Event\Model\Inspection;

class InspectionFactory
{


    const VERY_URGENT_TEXT = "bardzo pilne";
    const URGENT_TEXT = "pilne";
    public function create(InputEvent $event): Inspection
    {
        $inspection = new Inspection();

        $isEmptyDate = trim($event->getDueDate()) === '';
        $dueDate = $isEmptyDate ? null : new \DateTime($event->getDueDate());
        $isVeryUrgent = stripos($event->getDescription(), self::VERY_URGENT_TEXT) !== false;
        $isUrgent = stripos($event->getDescription(), self::URGENT_TEXT) !== false;
        $priority = $isVeryUrgent ? Priority::CRITICAL : ($isUrgent ? Priority::HIGH : Priority::NORMAL);
        $status = $isEmptyDate ? Status::NEW : Status::PLANNED;


        $inspection->setNumber($event->getNumber());
        $inspection->setDescription($event->getDescription());
        $inspection->setDateOfVisit($dueDate);
        $inspection->setStatus($status);
        $inspection->setClientPhoneNumber($event->getPhone());
        $inspection->setPriority($priority);
        $inspection->setCreatedAt(new \DateTime());

        return $inspection;

    }
}