<?php

namespace Lukimoore\SgApp\Normalizer;

use Lukimoore\SgApp\Dto\TaskFileRecordDto;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class TaskFileRecordDtoDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    private const DENORMALIZED_CALLED_KEY = 'denormalized_task_file_record_dto_called';

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
    {
        $data['rawData'] = $data;

        if (isset($data['dueDate']) && trim($data['dueDate']) === '') {
            $data['dueDate'] = null;
        }

        $context[self::DENORMALIZED_CALLED_KEY] = true;

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return $type === TaskFileRecordDto::class && !isset($context[self::DENORMALIZED_CALLED_KEY]);
    }

    /**
     * @param string|null $format
     * @return array<string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [TaskFileRecordDto::class => false];
    }
}