<?php

namespace Lukimoore\SgApp\Parser;

use Lukimoore\SgApp\Dto\TaskFileRecordDto;

class FailedRecord
{
    private TaskFileRecordDto $record;
    private string $cause;

    public function __construct(TaskFileRecordDto $record, string $cause)
    {
        $this->record = $record;
        $this->cause = $cause;
    }

    public function getRecord(): TaskFileRecordDto
    {
        return $this->record;
    }

    public function getCause(): string
    {
        return $this->cause;
    }
}