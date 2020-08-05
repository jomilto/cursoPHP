<?php

require_once('app/Models/Job.php');
require_once('app/Models/Project.php');
require_once('app/Models/Printable.php');
require_once('lib1/Project.php');

use App\Models\Job;
use App\Models\Project;

// las interfaces sirven para "validar", que el dato que se envia,
// a las funciones contenga ciertos metodos declarados o tipos de datos
// en la clase se debe agregar que se implementa(implements) la interface

$job1 = new Job('PHP Developer','Awesome job!!!!');
$job1->months = 16;

$job2 = new Job('Python Developer','Great job!!!!');
$job2->months = 12;

$job3 = new Job('','Undefined job!!!!');
$job3->months = 4;

$project1 = new Project('Project 1', 'First Project');

$projectLib = new Lib1\Project();

$jobs = [
  $job1,
  $job2,
  $job3
];

$projects = [
  $project1,
];