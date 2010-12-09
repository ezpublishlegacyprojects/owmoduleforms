<?php

class ezjscOwFormServerFunctions extends ezjscServerFunctions
{

    public static function callValidator($validator_class_name, $value, $params=array())
    {
        $result = false;
        try
        {
            $reflection = new ReflectionClass($validator_class_name);
            $customValidator = $reflection->newInstance($value, $params);
            if (!$customValidator->validate())
            {
                $result = $customValidator->getErrorMessage();
            }
        }
        catch (Exception $e)
        {
            eZDebug::writeError('form validator class ' . $validator_class_name. ' does not exist');
        }
        return $result;
    }


    public static function validate($args)
    {
        $value = false;
        $validator_class_name=false;
        $validation_params = array();
        $result = '';

        foreach ($_POST as $post_variable_name => $post_variable_value)
        {
            if ('value' == $post_variable_name)
            {
                $value = $post_variable_value;
            }
            elseif ('validator' == $post_variable_name)
            {
                $validator_class_name = $post_variable_value;
            }
            elseif ('ezjscServer_function_arguments' != $post_variable_name)
            {
                $validation_params[$post_variable_name] = $post_variable_value;
            }
        }

        return self::callValidator($validator_class_name, $value, $validation_params);
    }

}

?>