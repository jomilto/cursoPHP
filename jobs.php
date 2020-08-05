<?php

class Job {
  private $title;
  public $description;
  public $visible;
  public $months;

  public function getTitle(){
    return $this->title;
  }

  public function setTitle($t)
  {
    $this->title = $t;
  }
}

$job1 = new Job();
$job1->setTitle('PHP Developer');
$job1->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi sapiente sed pariatur sint exercitationem eos expedita eveniet veniam ullam, quia neque facilis dicta voluptatibus. Eveniet doloremque ipsum itaque obcaecati nihil.';
$job1->visible = True;
$job1->months = 16;

$job2 = new Job();
$job2->setTitle('Python Developer');
$job2->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi sapiente sed pariatur sint exercitationem eos expedita eveniet veniam ullam, quia neque facilis dicta voluptatibus. Eveniet doloremque ipsum itaque obcaecati nihil.';
$job2->visible = True;
$job2->months = 12;

  $jobs = [
    $job1,
    $job2
    // [
    //   'title'=>'Python Developer',
    //   'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi sapiente sed pariatur sint exercitationem eos expedita eveniet veniam ullam, quia neque facilis dicta voluptatibus. Eveniet doloremque ipsum itaque obcaecati nihil.',
    //   'visible' => false,
    //   'months' => 24,
    // ],
    // [
    //   'title'=>'VB.NET Developer',
    //   'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi sapiente sed pariatur sint exercitationem eos expedita eveniet veniam ullam, quia neque facilis dicta voluptatibus. Eveniet doloremque ipsum itaque obcaecati nihil.',
    //   'visible' => True,
    //   'months' => 12,
    // ],
    // [
    //   'title'=>'Node Developer',
    //   'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi sapiente sed pariatur sint exercitationem eos expedita eveniet veniam ullam, quia neque facilis dicta voluptatibus. Eveniet doloremque ipsum itaque obcaecati nihil.',
    //   'visible' => true,
    //   'months' => 8,
    // ],
    // [
    //   'title'=>'Devops',
    //   'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi sapiente sed pariatur sint exercitationem eos expedita eveniet veniam ullam, quia neque facilis dicta voluptatibus. Eveniet doloremque ipsum itaque obcaecati nihil.',
    //   'visible' => True,
    //   'months' => 37,
    // ],
  ];

  function getDuration($months)
  {
    $years = floor($months/12);
    $months = $months%12;
    $message = "";
    if($years == 0 or $months >0){
      $message .="$months months";
    }
    if($years >= 1){
      $message = "$years years " . $message;
    }
    return $message;
  }

  function printJob($job){
    if ($job->visible == False){
      return;
     }

    $duration = getDuration($job->months);
    echo "<li class=\"work-position\">
            <h5>{$job->getTitle()}</h5>
            <p>{$job->description}</p>
            <p>{$duration} of experience</p>
            <strong>Achievements:</strong>
            <ul>
              <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
              <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
              <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
            </ul>
          </li>";
  }