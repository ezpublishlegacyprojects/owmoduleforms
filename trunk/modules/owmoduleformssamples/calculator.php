<?php

class calculatorSubmit extends owFormSubmit
{
    public function __construct()
    {
        parent::__construct(array('template_path' => 'owmoduleformssamples/calculator_submit.tpl'));
    }

    public function setVariablesToTemplate($form, $tpl)
    {
        $tpl->setVariable('result', $form->getResult());
    }
}

class calculatorForm extends owForm
{
    var $result;

    function init()
    {
        $first_operand = new owFormText(
        array(
            	'name' => 'first_operand',
            	'label' => 'First operand',
                'validation' => array('owIntegerValidator' => array()),
        )
        );
        $second_operand = new owFormText(
        array(
            	'name' => 'second_operand',
            	'label' => 'Second operand',
                'validation' => array('owIntegerValidator' => array()),
        )
        );
        $operator = new owFormSelect(
        array(
            	'name' => 'operator',
            	'label' => 'Operator',
                'values' => array(
                    'sum' => '+',
                    'sub' => '-',
                    'mul' => '*',
                    'div' => '/',
        ),
        )
        );

        $this->addFormElement($first_operand);
        $this->addFormElement($operator);
        $this->addFormElement($second_operand);
    }

    function doProcess()
    {
        $form_data = $this->getValue();
        $first_operand = $form_data['first_operand'];
        $operator = $form_data['operator'];
        $second_operand = $form_data['second_operand'];
        $result = 'inconsistent result';
        if ('sum' == $operator)
        {
            $result = $first_operand + $second_operand;
        }
        elseif('sub' == $operator)
        {
            $result = $first_operand - $second_operand;
        }
        elseif('mul' == $operator)
        {
            $result = $first_operand * $second_operand;
        }
        elseif('div' == $operator)
        {
            if ($second_operator == 0)
            {
                $result = 'unable to divide by 0';
            }
            else
            {
                $result = $first_operand / $second_operand;
            }
        }
        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }
    
    function getSubmitButton()
    {
        return new calculatorSubmit();
    }

}

$title = ezi18n( 'extension/owmoduleforms', 'Sample Calculator' );
$form = new calculatorForm(
array(
    	'name' => 'calculator',
    	'method' => 'post',
    	'title' => $title,
    	'module' => $Module
)
);
$Module->setTitle($title);

$Result = array();
$Result['layout'] = false;
$Result['content'] = $form->render();
$Result['path'] = array( array( 'url' => '/owmoduleformssamples/calculator/',
                                'text' =>  $title) );

?>