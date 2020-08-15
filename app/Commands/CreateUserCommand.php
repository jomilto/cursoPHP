<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Models\User;

class CreateUserCommand extends Command{
    protected static $defaultName = 'app:create-user';

    public function configure()
    {
        $this->addArgument('email', InputArgument::REQUIRED, 'The email of the user.')
             ->addArgument('password', InputArgument::OPTIONAL, 'The password of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Creator',
           '============',
           '',
        ]);
        $password = $input->getArgument('password') ?? 'UnPassMuySeguro';

        $user = new User();
        $user->email = $input->getArgument('email');
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();
        $output->writeln('Done.');
        return Command::SUCCESS;
    }
}