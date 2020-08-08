<?php

namespace App\Controllers;

use App\Models\{Job,Project};

class IndexController extends BaseController{
    public function index()
    {          
        $jobs = Job::all();
        $projects = Project::all();
        $lastName = 'My lastname';
        $name = 'My name';
        $limitMonths = 120;

        return $this->renderHTML('index.twig',[
            'name' => $name,
            'jobs' => $jobs,
            'projects' => $projects,
        ]);
    }
}