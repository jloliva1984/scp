<?php 
function display_errors($validation,$field_name)
{
    if ($validation->hasError('usuario'))
    {
        return $validation->getError($field_name);

    }
    else
    {
        return false;
    }
}





?>