<?php

namespace App\Domain\Event\Model;

class InputEvent
{
    public function __construct(
        private int $number,
        private string $description,
        private ?string $dueDate,
        private ?string $phone
    ) {
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }


}