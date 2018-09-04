<?php

namespace AppBundle\Command\Production;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    public function configure()
    {
        $this
            ->setName('app:production:update')
            ->setDescription('Install the project on the production server')
            ->addOption('drop-database', null, InputOption::VALUE_NONE, 'If you want to drop the current database to install new schemas');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Update of the project production');
        /* Update project from github */
        $fetchAllProcess = new Process('git fetch --all');
        $fetchAllProcess->run();

        $resetMaster = new Process('git reset --hard origin/master');
        $resetMaster->run();

        /* Install vendor */
        $composerInstall = new Process('composer install');
        $composerInstall->run();

        /* Give write authorization in the project */
        $chmod = new Process('chmod -R 777 *');
        $chmod->run();


        $application = new Application($this->container->get('kernel'));
        $application->setAutoExit(false);

        /* Drop database */
        if($input->getOptions('drop-database')) {
            $databaseDrop = new ArrayInput(array(
                'command' => 'doctrine:database:drop --force',
            ));

            $databaseCreate = new ArrayInput(array(
                'command' => 'doctrine:database:create',
            ));
            $databaseSessionCreationTable = new ArrayInput(array(
                'command' => 'app:session:create_table',
            ));
            $application->run($databaseDrop, $output);
            $application->run($databaseCreate, $output);
            $application->run($databaseSessionCreationTable, $output);
        }

        $databaseSchemaUpdate = new ArrayInput(array(
                'command' => 'doctrine:schema:update --force',
        ));
        $application->run($databaseSchemaUpdate, $output);

    }
}
