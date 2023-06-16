<?php

namespace App\Domain\Event\Factory;

use App\Domain\Event\Enum\Status;
use App\Domain\Event\Model\InputEvent;
use App\Domain\Event\Model\Failure;


class FailureFactory
{

    public function create(InputEvent $event): Failure
    {
        $failure = new Failure();

        $isEmptyDate = trim($event->getDueDate()) === '';
        $dueDate = $isEmptyDate ? null : new \DateTime($event->getDueDate());
        $status = $isEmptyDate ? Status::NEW : Status::PLANNED;

        $failure->setNumber($event->getNumber());
        $failure->setDescription($event->getDescription());
        $failure->setDate($dueDate);
        $failure->setWeekOfYear($dueDate ? $dueDate->format('W') : null);
        $failure->setStatus($status);
        $failure->setPhoneNumber($event->getPhone());
        $failure->setCreatedAt(new \DateTime());

        return $failure;
    }
}