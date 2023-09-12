<?php

namespace Lukimoore\SgApp\TaskParser;

use Lukimoore\SgApp\Dto\TaskFileRecordDto;
use Lukimoore\SgApp\Enum\TaskStatusEnum;
use Lukimoore\SgApp\Model\InspectionTask;
use Lukimoore\SgApp\Model\Task;

class InspectionTaskParser implements TaskParserInterface
{
    public function parse(TaskFileRecordDto $record): Task
    {
        return new InspectionTask(
            $record->getDescription(),
            $record->getDueDate() === null ? TaskStatusEnum::NEW : TaskStatusEnum::SCHEDULED,
            $record->getPhone(),
            $record->getDueDate(),
            null
        );
    }

    public function supports(TaskFileRecordDto $record): bool
    {
        return str_contains($record->getDescription(), 'przegląd');
    }
}