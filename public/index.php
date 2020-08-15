<?php

    require_once('../vendor/autoload.php');

    session_start();
    
    use Aura\Router\RouterContainer;
    
    use Zend\Diactoros\Response;
    use Zend\Diactoros\ServerRequestFactory;
    use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

    use WoohooLabs\Harmony\Harmony;
    use WoohooLabs\Harmony\Middleware\DispatcherMiddleware;
    use WoohooLabs\Harmony\Middleware\HttpHandlerRunnerMiddleware;
    
    use \Franzl\Middleware\Whoops\WhoopsMiddleware;

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    // create a log channel
    $log = new Logger('app');
    $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::WARNING));

    if($_ENV['DEBUG']=='true'){
        ini_set('display_errors', 1);
        ini_set('display_startup_error',1);
        error_reporting(E_ALL);
    }

    $container = new DI\Container();
    
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

    $map->get('contactForm',lookRoute('/contact'),[
        'App\Controllers\ContactController',
         'index'
    ]);

    $map->post('contactSend',lookRoute('/contact/send'),[
        'App\Controllers\ContactController',
        'send'
    ]);

    $matcher = $routeContainer->getMatcher();

    $route = $matcher->match($request);

    if (!$route){
        echo 'Esta ruta no existe';
    }else{

        try {
            $harmony = new Harmony($request, new Response());
            $harmony
                ->addMiddleware(new HttpHandlerRunnerMiddleware(new SapiEmitter()));
            if($_ENV['DEBUG'] == 'true'){
                $harmony->addMiddleware(new WhoopsMiddleware());
            }
            $harmony->addMiddleware(new \App\Middlewares\AuthMiddleware())
                    ->addMiddleware(new Middlewares\AuraRouter($routeContainer))
                    ->addMiddleware(new DispatcherMiddleware($container,'request-handler'));
            $harmony->run();
        } catch (Exception $e) {
            // add records to the log
            $log->warning($e->getMessage());
            $emitter = new SapiEmitter();
            $emitter->emit(new Response\EmptyResponse(400));
        }// } catch (Error $e) {
        //     $emitter = new SapiEmitter();
        //     $emitter->emit(new Response\EmptyResponse(500));
        // }

       


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
    