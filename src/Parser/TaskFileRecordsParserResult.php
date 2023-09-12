<?php

namespace Lukimoore\SgApp\Parser;

use Lukimoore\SgApp\Dto\TaskFileRecordDto;
use Lukimoore\SgApp\Enum\TaskTypeEnum;
use Lukimoore\SgApp\Model\Task;

class TaskFileRecordsParserResult
{
    /**
     * @var array<Task>
     */
    private array $processedTasks = [];

    /**
     * @var array<FailedRecord>
     */
    private array $failedRecords = [];


    public function addProcessedTask(Task $task): void
    {
        $this->processedTasks[] = $task;
    }

    public function addFailedRecord(FailedRecord $failedRecord): void
    {
        $this->failedRecords[] = $failedRecord;
    }

    /**
     * @return Task[]
     */
    public function getProcessedTasks(): array
    {
        return $this->processedTasks;
    }

    /**
     * @return array<string, Task[]>
     */
    public function getProcessedTasksByType(): array
    {
        $groupByType = [];

        foreach ($this->getProcessedTasks() as $task) {
            if(!isset($groupByType[$task->getType()->value])) {
                $groupByType[$task->getType()->value] = [];
            }
            $groupByType[$task->getType()->value][] = $task;
        }

        return $groupByType;
    }

    /**
     * @return FailedRecord[]
     */
    public function getFailedRecords(): array
    {
        return $this->failedRecords;
    }
}