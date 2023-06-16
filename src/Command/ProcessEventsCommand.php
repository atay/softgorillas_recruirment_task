<?php

namespace App\Command;

use App\Application\Event\Converter\FailureConverter;
use App\Application\Event\Converter\FailureConverterInterface;
use App\Application\Event\Converter\InspectionConverter;
use App\Application\Event\Converter\InspectionConverterInterface;
use App\Application\Event\InputEventFactoryInterface;
use App\Domain\Event\Factory\FailureFactory;
use App\Domain\Event\Factory\InspectionFactory;
use App\Domain\Event\Strategy\EventRecognizeStrategy;
use App\Domain\Exception\WrongDataException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:process-events',
    description: 'Add a short description for your command',
)]
class ProcessEventsCommand extends Command
{

    public function __construct(
        private InputEventFactoryInterface $eventFactory,
        private EventRecognizeStrategy $eventRecognizeStrategy,
        private FailureFactory $failureFactory,
        private InspectionFactory $inspectionFactory,
        private FailureConverterInterface $failureConverter,
        private InspectionConverterInterface $inspectionConverter,
    ) {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('event-source', InputArgument::REQUIRED, 'Path to the event source file')
            ->addOption('outInspection', 'i', InputOption::VALUE_OPTIONAL, 'Path to the inspection file')
            ->addOption('outFailureReport', 'f', InputOption::VALUE_OPTIONAL, 'Path to the failure report file')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $eventSourcePath = $input->getArgument('event-source');
        if (!file_exists($eventSourcePath)) {
            $io->error('Event source file does not exist');
            return Command::FAILURE;
        }

        $inspectionPath = $input->getOption('outInspection');
        if ($inspectionPath && !is_writable(dirname($inspectionPath))) {
            $io->error('Inspection file path is not writable');
            return Command::FAILURE;
        }

        $failureReportPath = $input->getOption('outFailureReport');
        if ($failureReportPath && !is_writable(dirname($failureReportPath))) {
            $io->error('Failure report file path is not writable');
            return Command::FAILURE;
        }


        $io->writeln('Event Source: ' . $eventSourcePath);
        $io->writeln('Inspection: ' . $inspectionPath);
        $io->writeln('Failure Report: ' . $failureReportPath);

        $failures = [];
        $inspections = [];
        $failedCount = 0;

        $jsonData = file_get_contents($eventSourcePath);
        $data = json_decode($jsonData, true);

        foreach ($data as $row) {
            try {
                $inputEvent = $this->eventFactory->createEvent($row);
                $io->write('Processing event: ' . $inputEvent->getNumber());
            } catch (WrongDataException $e) {
                $io->error($e->getMessage());
                $failedCount++;
                continue;
            }
            $eventType = $this->eventRecognizeStrategy->getEventType($inputEvent);

            $io->writeln(', event type is: ' . $eventType->value);
            if ($eventType === $eventType::INSPECTION) {
                $inspection = $this->inspectionFactory->create($inputEvent);
                $inspections[] = $inspection;
            } elseif ($eventType === $eventType::FAILURE) {
                $failureReport = $this->failureFactory->create($inputEvent);
                $failures[] = $failureReport;
            }
        }

        if ($inspectionPath) {
            $inspectionsDTO = [];
            foreach ($inspections as $inspection) {
                $inspectionsDTO[] = $this->inspectionConverter->convert($inspection);
            }
            $jsonData = json_encode($inspectionsDTO, JSON_PRETTY_PRINT);
            if (file_put_contents($inspectionPath, $jsonData) === false) {
                $io->error('Failed to write inspection file');
            }
        }

        if ($failureReportPath) {
            $failuresDTO = [];
            foreach ($failures as $failure) {
                $failuresDTO[] = $this->failureConverter->convert($failure);
            }
            $jsonData = json_encode($failuresDTO, JSON_PRETTY_PRINT);
            if (file_put_contents($failureReportPath, $jsonData) === false) {
                $io->error('Failed to write failure report file');
            }
        }


        $io->success('File was processed');
        $io->success('Inspections: ' . count($inspections));
        $io->success('Failures: ' . count($failures));

        $io->info('Failed during processing: ' . $failedCount);


        return Command::SUCCESS;
    }
}