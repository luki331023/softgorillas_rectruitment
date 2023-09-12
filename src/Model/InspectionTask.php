<?php

namespace Lukimoore\SgApp\Model;

use Lukimoore\SgApp\Enum\TaskStatusEnum;
use Lukimoore\SgApp\Enum\TaskTypeEnum;

class InspectionTask extends Task
{
    private ?\DateTimeInterface $inspectionDate;
    private ?string $afterInspectionRecommendation;

    public function __construct(
        string $description,
        TaskStatusEnum $status,
        string $phoneNumber,
        ?\DateTimeInterface $inspectionDate,
        ?string $afterInspectionRecommendation
    ) {
        $this->description = $description;
        $this->type = TaskTypeEnum::INSPECTION;
        $this->status = $status;
        $this->phoneNumber = $phoneNumber;
        $this->inspectionDate = $inspectionDate;
        $this->afterInspectionRecommendation = $afterInspectionRecommendation;
        $this->createdAt = new \DateTimeImmutable();
    }


    public function getInspectionDate(): ?\DateTimeInterface
    {
        return $this->inspectionDate;
    }

    public function getAfterInspectionRecommendation(): ?string
    {
        return $this->afterInspectionRecommendation;
    }

    public function getGetInspectionDateAsWeek(): ?int
    {
        if ($this->inspectionDate === null) {
            return null;
        }

        return (int) $this->inspectionDate->format('W');
    }
}