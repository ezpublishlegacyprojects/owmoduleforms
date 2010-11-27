<?php

class owIntegerValidator extends owNumericValidator
{
    
    function getValidator($min=false, $max=false)
    {
        return new eZIntegerValidator($min, $max);
    }
    
    function getNumericType()
    {
        return 'integer';
    }
    
}

?>