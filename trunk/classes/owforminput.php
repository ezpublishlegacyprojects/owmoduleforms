<?php 

abstract class owFormInput extends owFormElement
{
   var $label;
   var $value;
   var $html_attributes;
   var $http;
   
   public function __construct($name, $label=false, $html_attributes=array())
   {
      parent::__construct($name);
      $this->label = $label;
      $this->html_attributes = $html_attributes;
      $this->http = eZHTTPTool::instance();
      $this->value = isset($html_attributes['default_value']) ? $html_attributes['default_value'] : false;
   }
   
   function getSubmittedButton()
   {
      return false;
   }
   
   function getValue()
   {
      $method = $this->getFormMethod();
      if (owForm::FORM_GET_METHOD == $method)
      {
         return $this->http->getVariable($this->name, false);
      }
      else
      {
         return $this->http->variable($this->name, false);
      }
   }
   
   function isRequired()
   {
      if (!empty($this->html_attributes))
      {
         return isset($this->html_attributes['required']) && $this->html_attributes['required'];
      }
   }
   
   function validate()
   {
      $this->value = $this->getValue();
      if ($this->isRequired() && !$this->value)
      {
         $this->addError('The field '. $this->name . ' is not valid');
      }
   }
   
}

?>