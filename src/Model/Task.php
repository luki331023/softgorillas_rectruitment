<?php

namespace Lukimoore\SgApp\Model;

use Lukimoore\SgApp\Enum\TaskStatusEnum;
use Lukimoore\SgApp\Enum\TaskTypeEnum;

abstract class Task
{
    protected string $description;
    protected TaskTypeEnum $type;
    protected TaskStatusEnum $status;
    protected string $phoneNumber;
    protected \DateTimeInterface $createdAt;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getType(): TaskTypeEnum
    {
        return $this->type;
    }

    public function getStatus(): TaskStatusEnum
    {
        return $this->status;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }
}