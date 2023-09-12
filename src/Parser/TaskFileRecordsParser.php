<?php

namespace Lukimoore\SgApp\Parser;

use Lukimoore\SgApp\Dto\TaskFileRecordDto;
use Lukimoore\SgApp\TaskParser\TaskParserInterface;

class TaskFileRecordsParser
{
    /**
     * @param iterable<TaskParserInterface> $taskParsers
     */
    public function __construct(private readonly iterable $taskParsers)
    {
    }

    /**
     * @param array<TaskFileRecordDto> $records
     */
    public function parse(array $records): TaskFileRecordsParserResult
    {
        $result = new TaskFileRecordsParserResult();

        foreach ($records as $record) {
            foreach ($this->taskParsers as $taskParser) {
                if (!$taskParser->supports($record)) {
                    continue;
                }

                try {
                    $task = $taskParser->parse($record);

                    $result->addProcessedTask($task);
                } catch (\Throwable $throwable) {
                    $result->addFailedRecord(new FailedRecord($record, $throwable->getMessage()));
                }
            }
        }

        return $result;
    }
}