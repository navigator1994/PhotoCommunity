<?php


function load($file, $path = ".")
{
    $parts = explode('\\', $file);
    foreach($parts as $name);
    $path .=  '\\' ;

    if (file_exists($path . $name) && is_file($path . $name)) {
        require_once($path . $name);
    } else {
        $directories = "";
        $dir = "";
        $directories = scandir($path, 1);
        foreach( $directories as $dir ) {
            if(is_dir($path.$dir)) {
                if ($dir == "..") {break;}
                else {
                    load($file,$path . $dir);
                }
            }
        }

    }

}

function __autoload($class_name)
{
    $file = $class_name . '.php';
    load($file);
}

$Router = new \Modules\router();



