<?php

namespace Lukimoore\SgApp\Parser;

use Lukimoore\SgApp\Dto\TaskFileRecordDto;

class TaskFileRecordsParser
{
    /**
     * @param array<TaskFileRecordDto> $records
     */
    public function parse(array $records): TaskFileRecordsParserResult
    {
        $tasks = [];

        foreach ($records as $record) {
            // find suitable specific parser
            // parse
            // add to tasks
        }

        return new TaskFileRecordsParserResult();
    }
}