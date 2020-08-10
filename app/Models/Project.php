<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDefaultImage;

// require_once('BaseElement.php');

class Project extends Model{
    use HasDefaultImage;

    protected $table = "projects";

    function printElement(){
        if ($this->active == False){
          return;
          }

        echo   "<div class=\"project\">
                    <h5>{$this->title}</h5>
                    <div class=\"row\">
                        <div class=\"col-3\">
                            <img id=\"profile-picture\" src=\"{$this->getImage()}\" alt=\"\">
                        </div>
                        <div class=\"col\">
                            <p>{$this->description}</p>
                            <strong>Technologies used:</strong>
                            <span class=\"badge badge-secondary\">PHP</span>
                            <span class=\"badge badge-secondary\">HTML</span>
                            <span class=\"badge badge-secondary\">CSS</span>
                        </div>
                    </div>
                </div>";
      }
}