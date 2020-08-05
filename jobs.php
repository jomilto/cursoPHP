<?php

require_once('app/Models/Job.php');
require_once('app/Models/Project.php');

$job1 = new Job('PHP Developer','Awesome job!!!!');
$job1->months = 16;

$job2 = new Job('Python Developer','Great job!!!!');
$job2->months = 12;

$job3 = new Job('','Undefined job!!!!');
$job3->months = 4;

$project1 = new Project('Project 1', 'First Project');

$jobs = [
  $job1,
  $job2,
  $job3
];

$projects = [
  $project1,
];