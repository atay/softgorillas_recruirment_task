<?php

namespace App\Domain\Event\Model;

use App\Domain\Event\Enum\EventType;
use App\Domain\Event\Enum\Status;


class Failure
{

    private int $number;

    private string $description;
    private ?\DateTime $date;
    private ?int $weekOfYear;
    private Status $status;
    private ?string $recommendation = null;
    private ?string $phoneNumber;
    private \DateTime $createdAt;

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDate(?\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setWeekOfYear(?int $weekOfYear): void
    {
        $this->weekOfYear = $weekOfYear;
    }

    public function getWeekOfYear(): ?int
    {
        return $this->weekOfYear;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setRecommendation(?string $recommendation): void
    {
        $this->recommendation = $recommendation;
    }

    public function getRecommendation(): ?string
    {
        return $this->recommendation;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    public function getType(): EventType
    {
        return EventType::FAILURE;
    }
}