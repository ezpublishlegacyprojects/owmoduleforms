<?php

class owInArrayValidator extends owFormValidator
{

    public function getErrorMessage()
    {
        return ' is not a valid item (valid items are in: '.implode(',', $this->getValidItems()). ')';
    }

    public function getValidItems()
    {
        if (array_key_exists('valid_items', $this->params))
        {
            return $this->params['valid_items'];
        }
        else
        {
            eZDebug::writeError('Unable to use owInArrayValidator because valid_items is not defined');
            return array();
        }
    }

    public function validate()
    {
        return in_array($this->input_value, $this->getValidItems());
    }

}

?>