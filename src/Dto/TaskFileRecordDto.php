<?php

namespace Lukimoore\SgApp\Dto;

class TaskFileRecordDto
{
    public function __construct(
        private readonly int $number,
        private readonly string $description,
        private readonly ?\DateTimeInterface $dueDate,
        private readonly ?string $phone
    ) {
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
}