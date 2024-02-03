<?php

namespace App\Command;

use Config\Application;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'make:command')]
class MakeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Creates a new command class')
            ->addArgument('className', InputArgument::REQUIRED, 'The name of the command to create')
            ->addOption("name", "", InputOption::VALUE_REQUIRED, "Command Name, eg : name => php console greet --name='Jack'");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $className = $input->getArgument('className');
        $commandName = $input->getOption("name");

        // Generate controller code here
        $this->generateCommand($className, $commandName);

        $output->writeln("Command <info>$className</info> created successfully.");

        return Command::SUCCESS;
    }

    private function generateCommand($className, $commandName)
    {
        $content = "<?php\n"
                 . "namespace App\Command;\n"
                 . "\n"
                 ."use Symfony\Component\Console\Attribute\AsCommand;\n"
                 ."use Symfony\Component\Console\Command\Command;\n"
                 ."use Symfony\Component\Console\Input\InputInterface;\n"
                 ."use Symfony\Component\Console\Output\OutputInterface;\n"
                 ."\n"
                 ."#[AsCommand(name: '$commandName')]\n"
                 . "class $className extends Command\n"
                 . "{\n"
                 . "     protected function execute(InputInterface \$input, OutputInterface \$output)\n"
                 ."      {\n"
                 ."         //write your command logic here\n"
                 ."         \$output->writeln(\"it's work\");\n\n\n"
                 ."         return Command::SUCCESS;\n"
                 ."      }\n"
                 . "}\n";

        file_put_contents(Application::BASE_PATH . "/app/Command/$className.php", $content);
    }
}
