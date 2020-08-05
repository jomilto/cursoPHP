<?php

class Job {
  private $title;
  public $description;
  public $visible = True;
  public $months;

  public function __construct($title,$description){
    $this->setTitle($title);
    $this->description = $description;
  }

  public function getTitle(){
    return $this->title;
  }

  public function setTitle($t)
  {
    if ($t == ''){
      $this->title = 'N/A';
    }else{
      $this->title = $t;
    }
  }

  public function getDurationAsString()
  {
    $years = floor($this->months/12);
    $months = $this->months%12;
    $message = "";
    if($years == 0 or $months >0){
      $message .="$months months";
    }
    if($years >= 1){
      $message = "$years years " . $message;
    }
    return $message;
  }
}

$job1 = new Job('PHP Developer','Awesome job!!!!');
$job1->months = 16;

$job2 = new Job('Python Developer','Great job!!!!');
$job2->months = 12;

$job3 = new Job('','Undefined job!!!!');
$job3->months = 4;

  $jobs = [
    $job1,
    $job2,
    $job3
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

  function printJob($job){
    if ($job->visible == False){
      return;
     }

    $duration = $job->getDurationAsString();
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