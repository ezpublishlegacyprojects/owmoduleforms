<?php

class owFormDatetime extends owFormFieldset
{
    
    public function __construct($options=array())
    {
        $this->checkForRequiredOption('name', $options);
        $name = $options['name'];
        if (!array_key_exists('id', $options))
        {
            $this->setDefaultOption($options, 'id', $name);
        }
        parent::__construct($options);
        $year = new owFormText(array('label' => 'Year', 'size' => 5, 'name' => '_datetime_year_'.$name));
        $this->addFormElement($year);
        $month = new owFormText(array('label' => 'Month', 'size' => 3, 'name' => '_datetime_month_'.$name));
        $this->addFormElement($month);
        $day = new owFormText(array('label' => 'Day', 'size' => 3, 'name' => '_datetime_day_'.$name));
        $this->addFormElement($day);
        $hour = new owFormText(array('label' => 'Hour', 'size' => 3, 'name' => '_datetime_hour_'.$name));
        $this->addFormElement($hour);
        $minute = new owFormText(array('label' => 'Minute', 'size' => 3, 'name' => '_datetime_minute_'.$name));
        $this->addFormElement($minute);
    }

}

?>