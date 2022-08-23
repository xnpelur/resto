<?php

function autoload($class) 
{
    $file = '../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
}

spl_autoload_register('autoload');
