<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_error',1);
    error_reporting(E_ALL);

    require_once('../vendor/autoload.php');

    session_start();

    $serverName = $_SERVER['SERVER_NAME'];

    if ($serverName == 'localhost'){
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();
    }

    use Illuminate\Database\Capsule\Manager as Capsule;
    use Aura\Router\RouterContainer;
  
    $capsule = new Capsule;
    
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => $_ENV['DATABASE_URL'],
        'database'  => $_ENV['DB_NAME'],
        'username'  => $_ENV['DB_USER'],
        'password'  => $_ENV['DB_PWD'],
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
        $serverName = $_SERVER['SERVER_NAME'];
        if ($serverName == 'localhost'){
            return $baseDir.$route;
        }else{
            return $route;
        }
    }

    $routeContainer = new RouterContainer();

    $map = $routeContainer->getMap();

    $map->get('index',lookRoute('/'),[
        'controller' => 'App\Controllers\IndexController',
        'action' => 'index'
    ]);
    $map->get('addJobs',lookRoute('/jobs/add'),[
        'controller' => 'App\Controllers\JobsController',
        'action' => 'index',
        'auth' => true
    ]);

    $map->post('saveJobs',lookRoute('/jobs/add'),[
        'controller' => 'App\Controllers\JobsController',
        'action' => 'add',
        'auth' => true
    ]);

    $map->get('addUsers',lookRoute('/users/add'),[
        'controller' => 'App\Controllers\UsersController',
        'action' => 'index',
        'auth' => true
    ]);

    $map->post('saveUsers',lookRoute('/users/add'),[
        'controller' => 'App\Controllers\UsersController',
        'action' => 'add',
        'auth' => true
    ]);

    $map->get('loginForm',lookRoute('/login'),[
        'controller' => 'App\Controllers\AuthController',
        'action' => 'index'
    ]);

    $map->post('auth',lookRoute('/login'),[
        'controller' => 'App\Controllers\AuthController',
        'action' => 'auth'
    ]);

    $map->get('logout',lookRoute('/logout'),[
        'controller' => 'App\Controllers\AuthController',
        'action' => 'logout',
        'auth' => true
    ]);

    $map->get('admin',lookRoute('/admin'),[
        'controller' => 'App\Controllers\AdminController',
        'action' => 'index',
        'auth' => true
    ]);

    $matcher = $routeContainer->getMatcher();

    $route = $matcher->match($request);

    if (!$route){
        echo 'Esta ruta no existe';
    }else{
        $handlerData = $route->handler;
        $needsAuth = $handlerData['auth'] ?? false;
        $userId = $_SESSION['user_id'] ?? null;

        if($needsAuth && !$userId){
            $controllerName = 'App\Controllers\AuthController';
            $actionName = 'index';
        }else{
            $controllerName = $handlerData['controller'];
            $actionName = $handlerData['action'];
        }
        $controller = new $controllerName;
        $response = $controller->$actionName($request);

        foreach($response->getHeaders() as $name=>$values){
            foreach($values as $value){
                header(sprintf('%s: %s', $name,$value),false);
            }
        }

        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }

    // $route = $_GET['route'] ?? '/';

    // if ($route == '/'){
    //     require_once('../index.php');
    // }elseif($route == 'addJob'){
    //     require_once('../addJob.php');
    // }elseif($route == 'addProject'){
    //     require_once('../addProject.php');
    // }
    