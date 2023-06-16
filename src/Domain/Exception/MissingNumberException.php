<?php

namespace App\Domain\Exception;

class MissingNumberException extends WrongDataException
{
    public function __construct()
    {
        parent::__construct('Missing number');
    }
}