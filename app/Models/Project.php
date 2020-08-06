<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// require_once('BaseElement.php');

class Project extends Model{

    protected $table = "projects";

    function printElement(){
        if ($this->active == False){
          return;
          }

        echo   "<div class=\"project\">
                    <h5>{$this->title}</h5>
                    <div class=\"row\">
                        <div class=\"col-3\">
                            <img id=\"profile-picture\" src=\"https://ui-avatars.com/api/?name=John+Doe&size=255\" alt=\"\">
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