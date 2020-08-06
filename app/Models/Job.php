<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// require_once('BaseElement.php');

class Job extends Model{

    // public function __construct($title,$description)
    // {
    //     parent::__construct($title,$description);
    // }

    protected $table = "jobs";

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