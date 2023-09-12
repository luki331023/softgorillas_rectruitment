<?php

namespace Lukimoore\SgApp\Model;

use Lukimoore\SgApp\Enum\TaskPriorityEnum;
use Lukimoore\SgApp\Enum\TaskStatusEnum;
use Lukimoore\SgApp\Enum\TaskTypeEnum;

class AccidentTask extends Task
{
    private TaskPriorityEnum $priority;
    private ?\DateTimeInterface $serviceDate;
    private ?string $serviceRemarks;

    public function __construct(
        string $description,
        TaskStatusEnum $status,
        string $phoneNumber,
        TaskPriorityEnum $priority,
        ?\DateTimeInterface $serviceDate,
        ?string $serviceRemarks
    ) {
        $this->description = $description;
        $this->type = TaskTypeEnum::ACCIDENT;
        $this->status = $status;
        $this->priority = $priority;
        $this->phoneNumber = $phoneNumber;
        $this->serviceDate = $serviceDate;
        $this->serviceRemarks = $serviceRemarks;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getPriority(): TaskPriorityEnum
    {
        return $this->priority;
    }

    public function getServiceDate(): ?\DateTimeInterface
    {
        return $this->serviceDate;
    }

    public function getServiceRemarks(): ?string
    {
        return $this->serviceRemarks;
    }
}