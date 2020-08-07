<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_error',1);
    error_reporting(E_ALL);

    require_once('../vendor/autoload.php');

    use Illuminate\Database\Capsule\Manager as Capsule;
    use Aura\Router\RouterContainer;
  
    $capsule = new Capsule;
    
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'cursophp',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);
        
        // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();
    
    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();

    $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    );

    function lookRoute($route){
        $baseDir = "/".strtolower(basename(dirname(__DIR__)));
        return $baseDir.$route;
    }

    $routeContainer = new RouterContainer();

    $map = $routeContainer->getMap();

    $map->get('index',lookRoute('/'),'../index.php');
    $map->get('addJobs',lookRoute('/jobs/add'),'../addJob.php');

    $matcher = $routeContainer->getMatcher();

    $route = $matcher->match($request);

    if (!$route){
        echo 'Esta ruta no existe';
    }else{
        require $route->handler;
    }

    // $route = $_GET['route'] ?? '/';

    // if ($route == '/'){
    //     require_once('../index.php');
    // }elseif($route == 'addJob'){
    //     require_once('../addJob.php');
    // }elseif($route == 'addProject'){
    //     require_once('../addProject.php');
    // }
    