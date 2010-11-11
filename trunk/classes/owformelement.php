<?php

abstract class owFormElement
{
   var $name;
    
   public function __construct($name)
   {
      $this->name = $name;
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
}

?>