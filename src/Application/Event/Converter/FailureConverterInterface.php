<?php

namespace App\Application\Event\Converter;

use App\Domain\Event\Model\Failure;

interface FailureConverterInterface
{
    public function convert(Failure $failure): array;

}