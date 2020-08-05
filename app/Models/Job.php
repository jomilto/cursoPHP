<?php
namespace App\Models;

require_once('BaseElement.php');

class Job extends BaseElement{

    public function __construct($title,$description)
    {
        parent::__construct($title,$description);
    }

    public function printElement(){
        if ($this->visible == False){
          return;
          }
      
        $duration = $this->getDurationAsString();
        echo "<li class=\"work-position\">
                <h5>{$this->getTitle()}</h5>
                <p>{$this->description}</p>
                <p>{$duration} of experience</p>
                <strong>Achievements:</strong>
                <ul>
                  <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                  <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                  <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                </ul>
              </li>";
      }
}