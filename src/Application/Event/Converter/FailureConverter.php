<?php

namespace App\Application\Event\Converter;

use App\Domain\Event\Model\Failure;

class FailureConverter implements FailureConverterInterface
{
    public function convert(Failure $failure): array
    {
        return [
            'number' => $failure->getNumber(),
            'phone' => $failure->getPhoneNumber(),
            'description' => $failure->getDescription(),
            'date' => $failure->getDate()?->format('Y-m-d H:i:s'),
            'type' => $failure->getType()->value,
            'weekOfYear' => $failure->getWeekOfYear(),
            'status' => $failure->getStatus()->value,
            'recommendation' => $failure->getRecommendation(),
            'createdAt' => $failure->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}