<?php
session_start();
$begin_time = microtime(get_as_float);
try {
    require_once("Modules/start.php");
}
catch (\Exception $e)
{
    echo "Exception with code '". $e->getCode()."''. Message: " .$e->getMessage();
}
echo microtime(get_as_float) - $begin_time;
