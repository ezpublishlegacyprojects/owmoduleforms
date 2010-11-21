<?php

class owFormFile extends owFormInput
{

    function __construct($options=array())
    {
        $this->checkForRequiredOption('upload_dir_path', $options);
        parent::__construct($options);
        $this->available_html_attributes = array_merge($this->available_html_attributes, array('accept', 'readonly'));
    }

    function getValue()
    {
        $file_data = $_FILES[$this->getName()];
        return $file_data['name'] ? $file_data : false;
    }

    function selfValidate()
    {
        parent::selfValidate();
        $value = $this->getValue();
        $field = $this->isOptionDefined('label') ? $this->getOption('label') : $this->getName();
        $error = $value['error'];

        switch ($error)
        {
            case UPLOAD_ERR_OK:
                $error_message=false;
                break;
            case UPLOAD_ERR_INI_SIZE:
                $error_message='The uploaded file "'.$field.'" exceeds the upload_max_filesize directive in php.ini ('.ini_get('upload_max_filesize').')';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $error_message='The uploaded file "'.$field.'" exceeds the MAX_FILE_SIZE directive that was specified in the HTML form ('.$this->getOption('maxfilesize').')';
                break;
            case UPLOAD_ERR_PARTIAL:
                $error_message='The uploaded file "'.$field.'" was only partially uploaded';
                break;
            case UPLOAD_ERR_NO_FILE:
                $error_message='No file "'.$field.'" was uploaded';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $error_message='Missing a temporary folder for "'.$field.'"';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $error_message='Failed to write file "'.$field.'" to disk';
                break;
            case UPLOAD_ERR_EXTENSION:
                $error_message='A PHP extension stopped the file "'.$field.'" upload';
                break;
        }
        if ($error_message)
        {
            $this->addError($error_message);
        }
    }

    function submit()
    {
        $file_data = $this->getValue();
        $uploadfile = $this->getOption('upload_dir_path') . basename($file_data['name']);
        if (!move_uploaded_file($file_data['tmp_name'], $uploadfile))
        {
            eZDebug::writeError('Unable to move uploaded file !');
        }
    }
    
}

?>