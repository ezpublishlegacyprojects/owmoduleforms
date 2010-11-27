<?php

class owFloatValidator extends owNumericValidator
{

    function getValidator($min=false, $max=false)
    {
        return new eZFloatValidator($min, $max);
    }

    function getNumericType()
    {
        return 'float';
    }

}

?>