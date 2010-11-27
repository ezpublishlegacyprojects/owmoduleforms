<?php

class ezjscOwFormServerFunctions extends ezjscServerFunctions
{

    public static function validate($args)
    {
        $validation_method = isset($args[0]) ? $args[0] : false;
        $http = eZHTTPTool::instance();
        $params = array();
        $i=1;
        while ($i)
        {
            $arg = 'arg'.$i;
            if ($http->hasPostVariable($arg))
            {
                $params[] = $http->variable($arg);
            }
            else
            {
                break;
            }
            $i++;
        }

        if ($validation_method)
        {
            return $validation_method . ' avec ' . implode(',', $params);
        }
        else
        {
            return 'error while using ajax call';
        }

    }
}

?>
