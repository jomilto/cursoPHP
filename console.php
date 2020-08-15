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

// si se usa solo pdo, se debe preparar el query
// y no confiar en el usuario

// strip_tags(variable)
// htmlscapechars(variable)
// para convertir los textos de xss a html normal