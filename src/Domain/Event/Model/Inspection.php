<?php

namespace App\Domain\Event\Model;

use App\Domain\Event\Enum\EventType;
use App\Domain\Event\Enum\Priority;
use App\Domain\Event\Enum\Status;


class Inspection
{
    private int $number;

    private string $description;
    private Priority $priority;
    private ?\DateTime $dateOfVisit;
    private Status $status;
    private string $comments;
    private string $clientPhoneNumber;
    private \DateTime $createdAt;


    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getType(): EventType
    {
        return EventType::INSPECTION;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPriority(): Priority
    {
        return $this->priority;
    }

    public function getDateOfVisit(): ?\DateTime
    {
        return $this->dateOfVisit;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function getClientPhoneNumber(): string
    {
        return $this->clientPhoneNumber;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setDateOfVisit(?\DateTime $dateOfVisit): void
    {
        $this->dateOfVisit = $dateOfVisit;
    }

    public function setPriority(Priority $priority): void
    {
        $this->priority = $priority;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function setComments(string $comments): void
    {
        $this->comments = $comments;
    }

    public function setClientPhoneNumber(string $clientPhoneNumber): void
    {
        $this->clientPhoneNumber = $clientPhoneNumber;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }



}