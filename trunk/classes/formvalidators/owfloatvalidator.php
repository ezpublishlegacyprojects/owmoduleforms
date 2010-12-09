<?php

class owFloatValidator extends owNumericValidator
{

    public function getNumericType()
    {
        return 'float';
    }

    public function getValidator($min=false, $max=false)
    {
        return new eZFloatValidator($min, $max);
    }

}

?>