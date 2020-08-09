<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader as TwigViews;
use Twig\Environment;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;

class BaseController {
    protected $templateEngine;

    public function __construct()
    {
        $loader = new TwigViews('../views');
        $this->templateEngine = new Environment($loader, array(
            'debug'=>true,
            'cache' => false
        ));
    }

    public function renderHTML($fileName, $data = [])
    {
        return  new HtmlResponse(
                $this
                    ->templateEngine
                    ->render($fileName, $data)
                );
    }

    public function redirectHTML($route)
    {
        return new RedirectResponse($route);
    }
}