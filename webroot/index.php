<?php

spl_autoload_register(function($className) {
    $file = "{$className}.php";
    
    $file = str_replace(
        '\\', 
        DIRECTORY_SEPARATOR, 
        $file
    );
    
    $file = ROOT . $file;
    
    if (!file_exists($file)) {
        throw new \Exception("{$file} not found");
    }
    
    require_once $file;
});

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS);
define('VIEW_DIR', ROOT . 'View' . DS);
define('VENDOR_DIR', ROOT . 'vendor' . DS);

require VENDOR_DIR . 'autoload.php';

// temporary - refactor later
/**
 * remove DB config to file ROOT/config/config.yml
 * use composer to install: composer require symfony/yaml
 * $array = Yaml::parse(file_get_contents(path/to/config.yml))
 */
$dbConfig = Symfony\Component\Yaml\Yaml::parseFile(ROOT.'config'.DS.'dbconfig.yml');
$dsn = "mysql: host={$dbConfig['host']}; dbname={$dbConfig['dbname']}";

try {
    \Framework\Session::start();
    
    $loader = new \Twig_Loader_Filesystem(VIEW_DIR);
    $twig = new \Twig_Environment($loader);
    
    $request = new \Framework\Request($_GET, $_POST, $_FILES);
    $container = new \Framework\Container();
    
    // create objects for container
    $dbConnection = new \PDO($dsn, $dbConfig['user'], $dbConfig['pass']); 
    $dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $router = new \Framework\Router();
    $repositoryFactory = new \Framework\RepositoryFactory();
    $repositoryFactory->setPdo($dbConnection);
    
    $container
        ->set('pdo', $dbConnection)
        ->set('router', $router)
        ->set('repository_factory', $repositoryFactory)
        ->set('twig', $twig)
    ;
    
    $controller = $request->get('controller', 'Default');
    $action = $request->get('action', 'index');
    
    $controller = '\\Controller\\' . $controller . 'Controller'; // ex: '\Controller\Default' . 'Controller'
    $action .= 'Action'; // ex: 'feedback' . 'Action'
    
    $controller = new $controller();
    $controller->setContainer($container);
    $controller->doLayoutDecision();
    
    // var_dump($controller);die;
    
    if (!method_exists($controller, $action)) {
        throw new \Exception("Action {$action} not found");
    }
    
    $content = $controller->$action($request);
    
} catch (\Framework\Exception\NotFoundException $e) {
    $controller = new \Controller\ErrorController($e);
    $content = $controller->error404Action();
} catch (\Exception $e) {
    dump($e);
    $controller = new \Controller\ErrorController($e);
    $content = $controller->errorAction();
}

echo $content;