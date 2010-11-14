<?php

abstract class owFormElement
{
   var $name;
   var $errors;
   var $parent_form_element;
    
   public function __construct($name)
   {
      $this->name = $name;
      $this->errors = array();
      $this->setParentFormElement(false);
   }
   
   function setParentFormElement($form_element)
   {
      $this->parent_form_element = $form_element;
   }
   
   function attributes()
   {
      return array_keys(get_class_vars(get_class($this)));
   }

   function hasAttribute( $attr )
   {
      return in_array( $attr, $this->attributes() );
   }

   function attribute( $attr )
   {
      if ( $this->hasAttribute($attr))
      {
         return $this->$attr;
      }
      else
      {
         //TODO deal with exceptions
      }
   }
   
   function getFormMethod()
   {
      return $this->parent_form_element->getFormMethod();
   }
   
   function getFormTemplate()
   {
      return $this->parent_form_element->getFormTemplate();
   }
   
   function isValid()
   {
      return empty($this->errors);
   }
   
   function addError($error)
   {
      $this->errors[] = $error;
   }
}

?>