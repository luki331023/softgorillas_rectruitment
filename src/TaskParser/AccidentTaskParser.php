<?php

namespace Lukimoore\SgApp\TaskParser;

use Lukimoore\SgApp\Dto\TaskFileRecordDto;
use Lukimoore\SgApp\Enum\TaskPriorityEnum;
use Lukimoore\SgApp\Enum\TaskStatusEnum;
use Lukimoore\SgApp\Model\AccidentTask;
use Lukimoore\SgApp\Model\Task;

class AccidentTaskParser implements TaskParserInterface
{
    public function parse(TaskFileRecordDto $record): Task
    {
        return new AccidentTask(
            $record->getDescription(),
            $record->getDueDate() === null ? TaskStatusEnum::NEW : TaskStatusEnum::SCHEDULED,
            $record->getPhone(),
            $this->parsePriority($record->getDescription()),
            $record->getDueDate(),
            null
        );
    }

    private function parsePriority(string $description): TaskPriorityEnum
    {
        if (str_contains($description, 'bardzo_pilne')) {
            return TaskPriorityEnum::CRITICAL;
        } elseif (str_contains($description, 'pilne')) {
            return TaskPriorityEnum::HIGH;
        }
        return TaskPriorityEnum::NORMAL;
    }
    public function supports(TaskFileRecordDto $record): bool
    {
        return true;
    }

    public static function getDefaultPriority(): int
    {
        return -100;
    }
}