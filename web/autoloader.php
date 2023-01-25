<?php
namespace BlogPirat;

set_include_path(__DIR__.'/classes');

spl_autoload_register(function ($class_name) {

    $file_name = get_include_path()."/".$class_name . '.php';
    $file_name = str_replace("\\", "/", $file_name);
    if (file_exists($file_name)) {
        //echo $file_name;
        require_once($file_name);
    } else {
        echo "file not found";
    }
});


