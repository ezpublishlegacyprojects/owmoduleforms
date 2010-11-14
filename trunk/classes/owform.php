<?php

require_once 'kernel/common/template.php';

abstract class owForm extends owFormContainer
{
   const FORM_GET_METHOD = 'get';
   const FORM_POST_METHOD = 'post';
   
   var $tpl;
   var $method;
   var $title;
   var $html_attributes;
   
   abstract function init();
   
   function __construct($name, $method=self::FORM_GET_METHOD, $title=false, $html_attributes=array())
   {
      parent::__construct($name);
      $this->method = $method;
      $this->title = $title;
      $this->html_attributes=$html_attributes;
      $this->tpl = eZTemplate::factory();
      $this->init();
      $this->initFormButtons();
   }
   
   function render()
   {
      $submittedButton = $this->getSubmittedButton();
      if ($submittedButton)
      {
         $this->validate();
         if ($this->isValid())
         {
            $submittedButton->process();
            return $submittedButton->renderValidation();
         }
         else
         {
            $this->tpl->setVariable('errors', $this->errors);
            return $this->renderForm();
         }         
      }
      else
      {
         return $this->renderForm();
      }
   }
   
   public function renderForm()
   {
      $this->tpl->setVariable('form_elements', $this->form_elements);
      $this->tpl->setVariable('form_method', $this->method);
      $this->tpl->setVariable('form_name', $this->name);
      $this->tpl->setVariable('form_title', $this->title);
      $this->tpl->setVariable('form_attributes', $this->html_attributes);
      return $this->tpl->fetch( "design:owmoduleforms/form.tpl" );
   }
   
   public function getTemplate()
   {
      return $this->tpl;
   }
   
   function initFormButtons()
   {
      $buttons_group = new owFormContainer('buttons');
      $buttons_group->addFormElement(new owFormSubmit('submit'));
      $buttons_group->addFormElement(new owFormSubmit('cancel'));
      $this->addFormElement($buttons_group);
   }
   
   function validate()
   {
      parent::validate();
      $this->validateForm();
   }
   
   function getFormMethod()
   {
      return $this->method;
   }
   
   function getFormTemplate()
   {
      return $this->tpl;
   }
   
   function validateForm()
   {
      /* do nothing
       * must be extended for custom form validation
       */
   }
  
}