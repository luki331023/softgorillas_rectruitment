<?php

namespace Lukimoore\SgApp\Command;

use League\Flysystem\FilesystemOperator;
use Lukimoore\SgApp\Parser\TaskFileRecordsParser;
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

        // print result details

        return Command::SUCCESS;
    }
}