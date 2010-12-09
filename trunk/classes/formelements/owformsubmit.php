<?php

class owFormSubmit extends owFormInput
{

    public function __construct($options=array())
    {
        $this->setDefaultOption($options, 'name', 'submit');
        $this->setDefaultOption($options, 'class', 'button');
        $this->setDefaultOption($options, 'template_name', 'submit_confirm.tpl');
        $this->setDefaultOption($options, 'variables', array('confirm_message' => 'Form successfully submitted!'));
        parent::__construct($options);
    }

    public function getSubmittedButton()
    {
        return array_key_exists($this->getName(), $_REQUEST) ? $this : false;
    }

    public function renderSubmit($form)
    {
        $tpl = $form->getFormTemplate();
        $variables = $this->getOption('variables');
        foreach ($variables as $variable_name => $variable_value)
        {
            $tpl->setVariable($variable_name, $variable_value);
        }
        $submitted_data = array();
        foreach($form->getSubmittedData() as $element)
        {
            $name = $element->getName();
            $submitted_data[$name] = array(
                'label' => $element->getLabel() ? $element->getLabel() : $name,
                'type' => get_class($element),
                'value' => $element->getValue(),
            );
            
        }
        $tpl->setVariable('submitted_data', $submitted_data);
        return $tpl->fetch('design:owmoduleforms/'.$this->getOption('template_name'));
    }

    public function submit($form)
    {
        $form->validate($form->getHttpFormMethod());
        if ($form->isValid())
        {
            $form->processSubmit();
            $form->doProcess();
            return $this->renderSubmit($form);
        }
        else
        {
            return $form->renderForm();
        }
    }

}

?>