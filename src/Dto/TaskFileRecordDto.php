<?php

namespace Lukimoore\SgApp\Dto;

class TaskFileRecordDto
{
    /**
     * @param array<string, mixed> $rawData
     */
    public function __construct(
        private readonly int $number,
        private readonly string $description,
        private readonly ?\DateTimeInterface $dueDate,
        private readonly ?string $phone,
        private readonly array $rawData
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

    /**
     * @return array<string, mixed>
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }
}