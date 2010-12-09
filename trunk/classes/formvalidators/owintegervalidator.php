<?php

class owIntegerValidator extends owNumericValidator
{

    public function getNumericType()
    {
        return 'integer';
    }

    public function getValidator($min=false, $max=false)
    {
        return new eZIntegerValidator($min, $max);
    }

}

?>