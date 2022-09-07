<?php

function autoload($class) 
{
    $file = '../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    $file = str_replace('App', 'app', $file);
    
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
}

spl_autoload_register('autoload');
