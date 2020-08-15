#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Commands\HelloWorldCommand;
use App\Commands\SendMailCommand;
use \App\Commands\CreateUserCommand;

$application = new Application();

// ... register commands
$application->add(new HelloWorldCommand());
$application->add(new SendMailCommand());
$application->add(new CreateUserCommand());
$application->run();

// abrir crontab
// vi /etc/crontab
// crontab.guru
// despues de modificar:
// sudo systemctl restart cron