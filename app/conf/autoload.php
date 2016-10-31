<?php

function my_autoload($className) {
    $className="src/".$className.".php";
    require_once str_replace("\\","/", $className);
}

spl_autoload_register('my_autoload');