<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// try {
//     $serverName = $_SERVER['SERVER_NAME'];
// } catch (Exception $e) {
//     $serverName="localhost";
// }


// if ($serverName == 'localhost'){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
// }

$capsule = new Capsule;
    
    $capsule->addConnection([
        'driver'    => $_ENV['DB_DRIVER'],
        'host'      => $_ENV['DB_HOST'],
        'database'  => $_ENV['DB_NAME'],
        'username'  => $_ENV['DB_USER'],
        'password'  => $_ENV['DB_PWD'],
        'port'      => $_ENV['DB_PORT'],
        'sslmode'   => $_ENV['SSLMODE'],
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);
        
        // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();
    
    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();