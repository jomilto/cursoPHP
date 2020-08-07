<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader as TwigViews;
use Twig\Environment;

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
        return $this
                    ->templateEngine
                    ->render($fileName, $data);
    }
}