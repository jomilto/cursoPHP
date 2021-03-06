<?php

namespace App\Models;

// require_once('Printable.php');

// las interfaces sirven para "validar", que el dato que se envia,
// a las funciones contenga ciertos metodos declarados o tipos de datos
// en la clase se debe agregar que se implementa(implements) la interface

class BaseElement implements Printable{
    // con private, solo esta clase puede acceder,
    // con protected, esta y las clases hijas pueden acceder
    private $title;
    public $description;
    public $visible = True;
    public $months;
  
    public function __construct($title,$description){
      $this->setTitle($title);
      $this->description = $description;
    }
  
    public function getDescription()
    {
      return $this->description;
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

    public function printElement(){
        echo 'OK';
    }
  }
  