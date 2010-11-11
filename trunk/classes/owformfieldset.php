<?php

class owFormFieldset extends owFormContainer
{
   var $legend;
   
   public function __construct($name, $legend=false)
   {
      parent::__construct($name);
      $this->legend = $legend;
   }
   
} 

?>