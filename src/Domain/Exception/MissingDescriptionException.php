<?php

namespace App\Domain\Exception;

class MissingDescriptionException extends WrongDataException
{
    public function __construct()
    {
        parent::__construct('Description is required');
    }
}