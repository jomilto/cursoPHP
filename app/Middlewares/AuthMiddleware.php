<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\EmptyResponse;

class AuthMiddleware implements MiddlewareInterface{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if($request->getUri()->getPath() === "/cursophp/admin"){
            $userId = $_SESSION['user_id'] ?? null;
            if(!$userId){
                    return new EmptyResponse(401);
                    // $controllerName = 'App\Controllers\AuthController';
                    // $actionName = 'index';
            }
        }
        return $handler->handle($request);
    }
}