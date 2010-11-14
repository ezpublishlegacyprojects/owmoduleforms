<?php

class owFormMarkup extends owFormElement
{
   var $attributes;
   
   public function __construct($name, $attributes=array())
   {
      parent::__construct($name);
      $this->attributes = $attributes;
   }

}

?>