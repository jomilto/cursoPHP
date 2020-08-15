<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class HelloWorldCommand extends Command{
    protected static $defaultName = 'app:hello-world';

    public function configure()
    {
        $this
        ->addArgument('name',InputArgument::REQUIRED,'Nombre de usuario');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nombre = $input->getArgument('name');
        $output->writeln('Hello ' . $nombre);
        // ... put here the code to run in your command

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}