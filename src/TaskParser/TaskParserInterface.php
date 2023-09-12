<?php

namespace Lukimoore\SgApp\TaskParser;

use Lukimoore\SgApp\Dto\TaskFileRecordDto;
use Lukimoore\SgApp\Model\Task;

interface TaskParserInterface
{
    public function parse(TaskFileRecordDto $record): Task;
    public function supports(TaskFileRecordDto $record): bool;
}