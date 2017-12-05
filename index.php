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

$controller = $request->get('controller', 'Default');
$action = $request->get('action', 'index');

$controller = '\\Controller\\' . $controller . 'Controller'; // ex: '\Controller\Default' . 'Controller'
$action .= 'Action'; // ex: 'feedback' . 'Action'

$controller = new $controller();

if (!method_exists($controller, $action)) {
    throw new \Exception("Action {$action} not found");
}

$content = $controller->$action();
require VIEW_DIR . 'layout.phtml';