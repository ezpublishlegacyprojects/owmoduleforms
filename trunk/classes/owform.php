<?php

require_once 'kernel/common/template.php';

abstract class owForm extends owFormContainer
{
   const FORM_GET_METHOD = 'get';
   const FORM_LOADED_STATUS = 'loaded';
   const FORM_SUBMITTED_STATUS = 'submitted';
   const FORM_VALIDATED_STATUS = 'validated';
   
   var $http;
   var $tpl;
   var $method;
   var $errors;
   var $status;
   
   function __construct($name)
   {
      parent::__construct($name);
      $this->status = self::FORM_LOADED_STATUS;
      $this->errors = array();
      $this->method = self::FORM_GET_METHOD; 
      $this->http = eZHTTPTool::instance();
      $this->tpl = eZTemplate::factory();
      $this->init();
      $this->initFormButtons();
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
   
   abstract function process();
   
   abstract function displayValidation();
   
   function submit()
   {
      $this->validate();
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
   
   function isSubmitted()
   {
      return self::FORM_SUBMITTED_STATUS == $this->status;
   }
   
   function isValidated()
   {
      return self::FORM_VALIDATED_STATUS == $this->status;
   }
   
   function display()
   {
      if ($this->isValidated())
      {
         $this->tpl->setVariable('validation', $this->displayValidation());
      }
      elseif ($this->isSubmitted())
      {
         $this->tpl->setVariable('errors', $this->errors);
         $this->tpl->setVariable('form_elements', $this->form_elements);
      }
      else
      {
         $this->tpl->setVariable('form_elements', $this->form_elements);
      }
      
      return $this->tpl->fetch( "design:owmoduleforms/form.tpl" );
   }
   
   public function getTemplate()
   {
      return $this->tpl;
   }
   
   function initFormButtons()
   {
      $cancel_button = new owFormSubmit('cancel');
      $submit_button = new owFormSubmit('submit');
      $buttons_group = new owFormContainer('buttons');
      $buttons_group->addFormElement($cancel_button);
      $buttons_group->addFormElement($submit_button);
      $this->addFormElement($buttons_group);
   }
}