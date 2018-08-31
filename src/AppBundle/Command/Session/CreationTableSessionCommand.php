<?php

namespace AppBundle\Command\Session;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CreationTableSessionCommand extends Command
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setName('app:session:create_table')
            ->setDescription('Create session table')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container->get('session.handler.pdo')->createTable();
    }
}
