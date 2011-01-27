<?php

class owFormHidden extends owFormInput
{

    var $type='hidden';
    
    public function __construct($options=array())
    {
        parent::__construct($options);
    }
    
}

?>