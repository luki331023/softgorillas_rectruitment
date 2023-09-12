<?php

namespace Lukimoore\SgApp\Command;

use League\Flysystem\FilesystemOperator;
use Lukimoore\SgApp\Parser\FailedRecord;
use Lukimoore\SgApp\Parser\TaskFileRecordsParser;
use Lukimoore\SgApp\Parser\TaskFileRecordsParserResult;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ProcessTasksFileCommand extends Command
{
    public function __construct(
        private readonly FilesystemOperator $localFilesystem,
        private readonly TaskFileRecordsParser $parser,
        private readonly SerializerInterface $serializer
    )
    {
        parent::__construct('sg:process-tasks-file');
    }

    protected function configure(): void
    {
        $this
            ->addArgument('filepath', InputArgument::REQUIRED, 'Filepath to source file inside "data" directory')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->localFilesystem->fileExists($input->getArgument('filepath'))) {
            $output->writeln('<error>Specified filepath does not exist</error>');

            return Command::FAILURE;
        }

        $result = $this->parser->parse(
            $this->serializer->deserialize(
                $this->localFilesystem->read($input->getArgument('filepath')),
                'Lukimoore\SgApp\Dto\TaskFileRecordDto[]',
                JsonEncoder::FORMAT
            )
        );

        $this->outputResultToConsole($result, $output);
        $this->outputResultAsFiles($result);

        return Command::SUCCESS;
    }

    private function outputResultToConsole(TaskFileRecordsParserResult $result, OutputInterface $output): void
    {
        foreach ($result->getProcessedTasksByType() as $type => $tasks) {
            $output->writeln(sprintf('Processed %d task with type %s', count($tasks), $type));
        }

        $output->writeln('----------------------');
        $output->writeln('Failed records:');

        foreach ($result->getFailedRecords() as $record) {
            $output->writeln(sprintf('%s : %s', $record->getRecord()->getNumber(), $record->getCause()));
        }
    }

    private function outputResultAsFiles(TaskFileRecordsParserResult $result): void
    {
        foreach ($result->getProcessedTasksByType() as $type => $tasks) {
            $this->localFilesystem->write(
                sprintf('output_%s.json', $type),
                $this->serializer->serialize($tasks, JsonEncoder::FORMAT)
            );
        }

        if (count($result->getFailedRecords()))
        {
            $this->localFilesystem->write(
                'failed_records.json',
                $this->serializer->serialize(
                    array_map(fn (FailedRecord $record) => $record->getRecord()->getRawData(), $result->getFailedRecords()),
                    JsonEncoder::FORMAT
                )
            );
        }
    }
}