<?php

namespace App\Application\Event\Converter;

use App\Domain\Event\Model\Inspection;

class InspectionConverter implements InspectionConverterInterface
{
    public function convert(Inspection $inspection): array
    {
        return [
            'number' => $inspection->getNumber(),
            'description' => $inspection->getDescription(),
            'dueDate' => $inspection->getDateOfVisit()?->format('Y-m-d H:i:s'),
            'clientPhoneNumber' => $inspection->getClientPhoneNumber(),
            'type' => $inspection->getType()->value,
            'status' => $inspection->getStatus()->value,
            'createdAt' => $inspection->getCreatedAt()->format('Y-m-d H:i:s'),

        ];
    }
}