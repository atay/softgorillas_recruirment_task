<?php

namespace App\Domain\Event\Enum;

enum Status: string
{
    case NEW = 'new';
    case PLANNED = 'planned';
    case TERMIN = 'termin';

}