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
        $limitMonths = 10;

        // $filterFun = function (array $job) use($limitMonths)
        // {
        //     return $job['months'] >= $limitMonths;
        // };

        // $jobs = array_filter($jobs->toArray(), $filterFun);

        return $this->renderHTML('index.twig',[
            'name' => $name,
            'jobs' => $jobs,
            'projects' => $projects,
        ]);
    }
}