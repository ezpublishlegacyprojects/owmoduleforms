<?php 

abstract class owFormInput extends owFormElement
{
   var $label;
   var $attributes;
   
   public function __construct($name, $label=false, $attributes=array())
   {
      parent::__construct($name);
      $this->label = $label;
      $this->attributes = $attributes;
   }
}

?>