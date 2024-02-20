<?php

namespace App\Command;

use Config\Application;
use Dotenv\Dotenv;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'migration')]
class migration extends Command
{
    protected function configure(): void
    {
        $this->setDescription("Run Migration")
            ->setHelp("This command allow you run migration by existing migration class")
            ->addArgument("migrationName", InputArgument::REQUIRED, "Name of the migration class [required]");
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->load();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $mname = $input->getArgument("migrationName");
        $name = "\DB\Migration\\" . $mname . "Migration";
        if (!class_exists($name)) {
            $output->writeln("$name class doesn't exist.");
        }
        $build =  new $name;
        $build->run();

        $output->writeln("$mname migration complete.");

        return Command::SUCCESS;
    }
}