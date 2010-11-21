<?php

class owFormSubmit extends owFormInput
{
    public function __construct($options=array())
    {
        $this->setDefaultOption($options, 'name', 'submit');
        $this->setDefaultOption($options, 'class', 'button');
        parent::__construct($options);
    }

    function getSubmittedButton()
    {
        return array_key_exists($this->getName(), $_REQUEST) ? $this : false;
    }

    function renderSubmit()
    {
        $tpl = $this->getFormTemplate();
        $tpl->setVariable('message', 'Form is submitted because you press on ' . $this->getName() . ' button');
        return $tpl->fetch( "design:owmoduleforms/submit.tpl" );
    }

}

?>