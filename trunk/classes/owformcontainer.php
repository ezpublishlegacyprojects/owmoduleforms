<?php

class owFormContainer extends owFormElement
{
   var $form_elements;
    
   public function __construct($name)
   {
      parent::__construct($name);
      $this->form_elements = array();
   }
    
   function addFormElement($element)
   {
      if ($element instanceof owFormElement)
      {
         $this->form_elements[] = $element;
      }
      else
      {
         //TODO deal with exceptions
      }
   }
}

?>