<?php
namespace App\Models;

use App\Traits\{HasDefaultImage};
use Illuminate\Database\Eloquent\Model;

// require_once('BaseElement.php');

class Job extends Model{
    use HasDefaultImage;
    // public function __construct($title,$description)
    // {
    //     parent::__construct($title,$description);
    // }

    protected $table = "jobs";

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


    public function printElement(){
        if ($this->active == False){
          return;
        }        
      
        $duration = $this->getDurationAsString();
        echo "  <h5>{$this->title}</h5>
                <p>{$this->description}</p>
                <p>{$duration} of experience</p>
                <strong>Achievements:</strong>
                <ul>
                  <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                  <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                  <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                </ul>";
      }
}