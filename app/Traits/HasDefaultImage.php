<?php

namespace App\Traits;

trait HasDefaultImage{
    public function getImage()
    {
        if(!$this->image){
            $altText=$this->title;
            return "https://ui-avatars.com/api/?name=$altText&size=160";
        }
        return $this->image;
    }
}