<?php

class owFormCancel extends owFormSubmit
{
    public function __construct($options=array())
    {
        $this->setDefaultOption($options, 'name', 'cancel');
        $this->setDefaultOption($options, 'label', 'Cancel');
        $this->setDefaultOption($options, 'redirect_uri', '/');
        parent::__construct($options);
    }

    public function submit($form)
    {
        if ($this->isOptionDefined('module'))
        {
            $module = $this->getOption('module');
            $module->redirectTo($this->getOption('redirect_uri'));
        }
    }

}

?>