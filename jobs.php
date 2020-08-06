<?php

// require_once('app/Models/Job.php');
// require_once('app/Models/Project.php');
// require_once('app/Models/Printable.php');
// require_once('lib1/Project.php');

// agregar al composer.json en autoload psr-4 donde se encuentran los archivos
// luego correr composer install o update y se actualizara
// con esto podemos eliminar todos los require
// require_once('vendor/autoload.php');

use App\Models\{Job, Project};
// use App\Models\Project;

// $job1 = new Job('PHP Developer','Awesome job!!!!');
// $job1->months = 16;

// $job2 = new Job('Python Developer','Great job!!!!');
// $job2->months = 12;

// $job3 = new Job('','Undefined job!!!!');
// $job3->months = 4;

// $jobs = [
//   $job1,
//   $job2,
//   $job3
// ];

// $projectLib = new Lib1\Project();

$jobs = Job::all();

$project1 = new Project('Project 1', 'First Project');

$projects = [
  $project1,
];