<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_error',1);
    error_reporting(E_ALL);

    require_once('../vendor/autoload.php');

    session_start();
    
    use Illuminate\Database\Capsule\Manager as Capsule;
    use Aura\Router\RouterContainer;
    
    use Zend\Diactoros\Response;
    use Zend\Diactoros\ServerRequestFactory;
    use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

    use WoohooLabs\Harmony\Harmony;
    use WoohooLabs\Harmony\Middleware\DispatcherMiddleware;
    use WoohooLabs\Harmony\Middleware\HttpHandlerRunnerMiddleware;

    $serverName = $_SERVER['SERVER_NAME'];

    if ($serverName == 'localhost'){
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();
    }

    $container = new DI\Container();
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

    $request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
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
         'App\Controllers\IndexController',
         'index'
    ]);

    $map->get('addJobs',lookRoute('/jobs/add'),[
        'App\Controllers\JobsController',
         'index',
        'auth' => true
    ]);

    $map->post('saveJobs',lookRoute('/jobs/add'),[
        'App\Controllers\JobsController',
         'add',
        'auth' => true
    ]);

    $map->get('deleteJobs',lookRoute('/jobs/delete'),[
        'App\Controllers\JobsController',
         'delete',
        'auth' => true
    ]);

    $map->get('addUsers',lookRoute('/users/add'),[
        'App\Controllers\UsersController',
         'index',
        'auth' => true
    ]);

    $map->post('saveUsers',lookRoute('/users/add'),[
        'App\Controllers\UsersController',
         'add',
        'auth' => true
    ]);

    $map->get('loginForm',lookRoute('/login'),[
        'App\Controllers\AuthController',
         'index'
    ]);

    $map->post('auth',lookRoute('/login'),[
        'App\Controllers\AuthController',
         'auth'
    ]);

    $map->get('logout',lookRoute('/logout'),[
        'App\Controllers\AuthController',
         'logout',
        'auth' => true
    ]);

    $map->get('admin',lookRoute('/admin'),[
        'App\Controllers\AdminController',
         'index',
        'auth' => true
    ]);

    $matcher = $routeContainer->getMatcher();

    $route = $matcher->match($request);

    if (!$route){
        echo 'Esta ruta no existe';
    }else{
        // $handlerData = $route->handler;
        // $needsAuth = $handlerData['auth'] ?? false;
        // $userId = $_SESSION['user_id'] ?? null;

        // if($needsAuth && !$userId){
        //     $controllerName = 'App\Controllers\AuthController';
        //     $actionName = 'index';
        // }else{
        //     $controllerName = $handlerData['controller'];
        //     $actionName = $handlerData['action'];
        // }
        $harmony = new Harmony($request, new Response());
        $harmony
            ->addMiddleware(new HttpHandlerRunnerMiddleware(new SapiEmitter()))
            ->addMiddleware(new Middlewares\AuraRouter($routeContainer))
            ->addMiddleware(new DispatcherMiddleware($container,'request-handler'))
            ->run();


        // $controller = $container->get($controllerName);
        // $response = $controller->$actionName($request);

        // foreach($response->getHeaders() as $name=>$values){
        //     foreach($values as $value){
        //         header(sprintf('%s: %s', $name,$value),false);
        //     }
        // }

        // http_response_code($response->getStatusCode());
        // echo $response->getBody();
    }

    // $route = $_GET['route'] ?? '/';

    // if ($route == '/'){
    //     require_once('../index.php');
    // }elseif($route == 'addJob'){
    //     require_once('../addJob.php');
    // }elseif($route == 'addProject'){
    //     require_once('../addProject.php');
    // }
    