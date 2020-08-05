<?php

namespace App\Models;

require_once('BaseElement.php');

class Project extends BaseElement{
    function printElement(){
        if ($this->visible == False){
          return;
          }

        echo   "<div class=\"project\">
                    <h5>{$this->getTitle()}</h5>
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