<?php

spl_autoload_register(function($className) {
    $file = "{$className}.php";
    
    $file = str_replace(
        '\\', 
        DIRECTORY_SEPARATOR, 
        $file
    );
    
    if (!file_exists($file)) {
        throw new \Exception("{$file} not found");
    }
    
    require_once $file;
});

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);
define('VIEW_DIR', ROOT . 'View' . DS);

$request = new \Framework\Request($_GET, $_POST, $_FILES);


require VIEW_DIR . 'layout.phtml';
