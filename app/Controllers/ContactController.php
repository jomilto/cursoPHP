<?php

namespace App\Controllers;

class ContactController extends BaseController{
    public function index()
    {
        return $this->renderHTML('contacts/index.twig');
    }
}