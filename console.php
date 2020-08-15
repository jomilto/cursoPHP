#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Commands\HelloWorldCommand;

$application = new Application();

// ... register commands
$application->add(new HelloWorldCommand());

$application->run();