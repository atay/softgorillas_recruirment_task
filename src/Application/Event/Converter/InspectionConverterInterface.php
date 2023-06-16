<?php

namespace App\Application\Event\Converter;

use App\Domain\Event\Model\Inspection;

interface InspectionConverterInterface
{
    public function convert(Inspection $inspection): array;
}