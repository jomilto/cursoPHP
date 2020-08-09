<?php

namespace App\Controllers;

use App\Models\{User};
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;

class AdminController extends BaseController {
    public function index(){
        return  $this->renderHTML('admin.twig');
    }
}