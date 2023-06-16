<?php

namespace App\Domain\Exceptions;

class InvalidEventException extends \Exception
{
    public static function missingNumber(): self
    {
        return new self('Event number is required');
    }

    public static function missingDescription(): self
    {
        return new self('Event description is required');
    }
}