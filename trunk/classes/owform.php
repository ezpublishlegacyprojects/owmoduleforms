<?php

abstract class owForm
{
   const FORM_GET_METHOD = 'get';
   const FORM_LOADED_STATUS = 'loaded';
   const FORM_SUBMITTED_STATUS = 'submitted';
   const FORM_VALIDATED_STATUS = 'validated';
   
   var $http;
   var $tpl;
   var $method;
   var $errors;
   var $form_elements;
   var $status;
   
   function __construct()
   {
      $this->status = self::FORM_LOADED_STATUS;
      $this->errors = array();
      $this->form_elements = array();
      $this->method = self::FORM_GET_METHOD; 
      $this->http = eZHTTPTool::instance();
      $this->tpl = templateInit();
      $this->init();
      $this->display();
   }
      
   function getParameterValue($name)
   {
      if (self::FORM_GET_METHOD == $this->method)
      {
         return $this->http->getVariable($name, false);
      }
      else
      {
         return $this->http->variable($name, false);
      }
   }
   
   function isFormValid()
   {
      return empty($this->errors);
   }
   
   function validate()
   {
      foreach ($this->form_elements as $element)
      {
         $error = $element->validate();
         if ($error)
         {
            $this->addError($error);
         }
      }
      $this->customValidate();
   }
   
   function addError($error)
   {
      $this->errors[] = $error;
   }
   
   abstract function init();
   
   abstract function customValidate();
   
   abstract function process();
   
   abstract function displayValidation();
   
   function submit()
   {
      $this->validate();
      $this->customValidate();
      if ($this->isFormValid())
      {
         $this->status = self::FORM_VALIDATED_STATUS;
         $this->process();
      }
      else
      {
         $this->status = self::FORM_SUBMITTED_STATUS;
      }
      $this->display();
   }
   
   function display()
   {
      if (self::FORM_VALIDATED_STATUS == $this->status)
      {
         $this->tpl->setVariable('validation', $this->displayValidation());
      }
      elseif (self::FORM_SUBMITTED_STATUS == $this->status)
      {
         $this->tpl->setVariable('errors', $this->errors);
         $this->tpl->setVariable('form_elements', $this->form_elements);
      }
      else
      {
         $this->tpl->setVariable('form_elements', $this->form_elements);
      }
   }
   
   public function getTemplate()
   {
      return $this->tpl;
   }
}