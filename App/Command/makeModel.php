<?php
namespace App\Command;

use Config\Application;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'make:model')]
class makeModel extends Command
{
   protected function configure()
   {
      $this->setDescription("Create a new Model Class")
           ->addArgument("className", InputArgument::REQUIRED, "the name of model class to create")
           ->addOption("migration", "m", InputOption::VALUE_NONE, "create model with its migration class");
   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {
      //write your command logic here
      $className = $input->getArgument("className");
      $withMigration = $input->getOption("migration") !== false;
      $this->generateModel($className);
      if($withMigration) {
         $this->generateMigration($className);
      }

      $addOutput = $withMigration ? "and migration" : "";
      $output->writeln("The $className-model $addOutput have been successfully created.");
      return Command::SUCCESS;
   }

   private function generateMigration($className)
   {
      $name = $className . "Migration";
      $content = "<?php\n"
               . "namespace DB\Migration;\n"
               . "use Core\Migrate\Migration;\n"
               . "use Core\Migrate\Scheme;\n"
               . "use Core\Migrate\SchemeBuilder;\n"
               . "\nclass postMigrate implements Migration {\n" 
               . "\n\tpublic function run() :void\n"
               . "\t{\n"
               . "\t\tScheme::create(\"".$name.'", function(SchemeBuilder $table) '. "{\n"
               . "\t\t\t//your migration code here..\n"
               . "\t\t\t".'$table->id();'."\n"
               . "\n"
               . "\t\t});\n"
               . "\t}\n"
               . "}";
      file_put_contents(Application::BASE_PATH . "/database/Migration/$name.php", $content);
   }

   private function generateModel($className)
   {
      $lowname = strtolower($className);
      $content = "<?php\n"
               . "namespace App\Model;\n"
               . "use Core\Model;\n\n"
               . "class $className extends Model {\n\n"
               . "   protected \$table = '$lowname';\n"
               . "   protected \$primaryKey = 'id';\n\n"
               . "   protected \$fillable = [\n\n"
               . "   ];\n"
               . "}";
      
      file_put_contents(Application::BASE_PATH . "/app/Model/$className.php", $content);
   }
}