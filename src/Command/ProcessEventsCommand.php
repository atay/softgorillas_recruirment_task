<?php

namespace App\Command;

use App\Application\Event\EventFactoryInterface;
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

    private EventFactoryInterface $eventFactory;

    public function __construct(EventFactoryInterface $eventFactory)
    {
        parent::__construct();
        $this->eventFactory = $eventFactory;
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
        $eventSource = $input->getArgument('event-source');
        $inspection = $input->getOption('outInspection');
        $failureReport = $input->getOption('outFailureReport');

        $io->writeln('Event Source: ' . $eventSource);
        $io->writeln('Inspection: ' . $inspection);
        $io->writeln('Failure Report: ' . $failureReport);

        $jsonData = file_get_contents($eventSource);
        $data = json_decode($jsonData, true);

        foreach ($data as $row) {
            $event = $this->eventFactory->createEvent($row);
            $io->writeln('Event: ' . $event->getDescription());
        }


        // 2DO write a service

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}