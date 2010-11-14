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
         $element->setParentFormElement($this);
         $this->form_elements[] = $element;
      }
      else
      {
         //TODO deal with exceptions
      }
   }
   
   function getSubmittedButton()
   {
      foreach ($this->form_elements as $element)
      {
         if ( $button = $element->getSubmittedButton())
         {
            return $button;
         }
      }
      return false;
   }
   
   function validate()
   {
      foreach ($this->form_elements as $element)
      {
         $element->validate();
         foreach ($element->errors as $error)
         {
            $this->addError($error);
         }
      }
   }
}

?>