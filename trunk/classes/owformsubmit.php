<?php

class owFormSubmit extends owFormInput
{
    public function __construct($options=array())
    {
        $this->setDefaultOption($options, 'name', 'submit');
        parent::__construct($options);
    }

    function getSubmittedButton()
    {
        return ($this->getName() == $this->getValue()) ? $this : false;
    }

    function process()
    {
        //do nothing
    }

    function renderValidation()
    {
        $tpl = $this->getFormTemplate();
        $tpl->setVariable('message', 'Form is submitted because you press on ' . $this->getName() . ' button');
        return $tpl->fetch( "design:owmoduleforms/submit.tpl" );
    }

}

?>