<?php

namespace App\Enum;

enum SymptomTimingType: string
{
    case PRE = 'pre';
    case DURING = 'during';
    case POST = 'post';
}
