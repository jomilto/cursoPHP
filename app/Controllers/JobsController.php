<?php

namespace App\Controllers;

use App\Models\{Job};

class JobsController extends BaseController {
    public function index(){
        echo  $this->renderHTML('addJob.twig');
    }
    public function add($request)
    {   
        //Obtenemos el metodo
        $metodo = $request->getMethod();
        // Obtenemos los datos

        $data = $request->getParsedBody();
        $job = new Job();
        $job->title = $data['title'];
        $job->description = $data['description'];
        $job->save();

        echo  $this->renderHTML('addJob.twig');
    }
}