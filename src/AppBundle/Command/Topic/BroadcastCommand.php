<?php

namespace AppBundle\Command\Topic;


use AppBundle\Service\Topic\TestTopic;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;

class BroadcastCommand extends Command
{

    private $topic;

    public function __construct(TestTopic $topic, ContainerInterface $container)
    {
        parent::__construct();
        $this->topic = $topic;
    }

    protected function configure()
    {
        $this
            ->setName('app:topic:broadcast')
            ->setDescription('Broadcast a message to user on channel')
            ->setHelp('This command allows you to create a user...')
            //->addArgument('message', InputArgument::REQUIRED)
            //->addArgument('channel', InputArgument::OPTIONAL)
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

    }
}
