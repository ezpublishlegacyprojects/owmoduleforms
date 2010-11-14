<?php 

class owFormSubmit extends owFormInput
{
   public function __construct($name='submit', $label=false, $attributes=array())
   {
      parent::__construct($name, $label, $attributes);
   }
   
   function getSubmittedButton()
   {
      return ($this->name == $this->getValue()) ? $this : false;
   }
   
   function process()
   {
      //do nothing
   }

   function renderValidation()
   {
      $tpl = $this->getFormTemplate();
      $tpl->setVariable('message', 'Form is submitted because you press on ' . $this->name . ' button');
      return $tpl->fetch( "design:owmoduleforms/submit.tpl" );
   }
   
}

?>