<?php

namespace App\Controllers;

use App\Models\{Job};

class JobsController{
    public function index(){
        include '../views/addJob.php';
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

        include '../views/addJob.php';
    }
}