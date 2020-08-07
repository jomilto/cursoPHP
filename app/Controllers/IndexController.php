<?php

namespace App\Controllers;

use App\Models\{Job,Project};

class IndexController{
    public function index()
    {          
        $jobs = Job::all();
        $projects = Project::all();
        $lastName = 'My lastname';
        $name = 'My name';
        $limitMonths = 120;

        include '../views/index.php';
    }
}