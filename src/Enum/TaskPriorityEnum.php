<?php

namespace Lukimoore\SgApp\Enum;

enum TaskPriorityEnum: string
{
    case NORMAL = 'normal';
    case HIGH = 'high';
    case CRITICAL = 'critical';
}
