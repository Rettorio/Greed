<?php
namespace App\Command;

use Config\Application;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'make:controller')]
class makeController extends Command
{
    protected function configure() :void
    {
        $this->setDescription("Make Controller")
             ->setHelp("This command allow you to create a controller")
             ->addArgument("controllerName", InputArgument::REQUIRED, "Name of the controller to create");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument("controllerName");
        $this->generateController($name);
        $output->writeln("$name controller created.");
        return Command::SUCCESS;

    }

    private function generateController($controllerName)
    {
        // Implement your controller generation logic
        // Example:
        $content = "<?php\n"
                 . "namespace App\Controllers;\n"
                 ."use Core\Controller;\n"
                 ."\n"
                 . "class $controllerName extends Controller {\n\n"
                 . "    // Controller actions here\n\n"
                 . "}\n";

        file_put_contents(Application::BASE_PATH. "/app/Controller/$controllerName.php", $content);
    }
}