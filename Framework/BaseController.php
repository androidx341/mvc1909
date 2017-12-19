<?php

namespace Framework;

abstract class BaseController
{
    protected $container;
    
    private $layout = 'layout.phtml';
    
    private function setAdminLayout()
    {
        $this->layout = 'admin_layout.phtml';
    }
    
    public function doLayoutDecision()
    {
        $class = get_class($this);
        
        if (strpos($class, 'Admin') !== false) {
            $this->setAdminLayout();    
        }
    }
    
    public function setContainer(Container $container)
    {
        $this->container = $container;
        
        return $this;
    }
    
    protected function render($template, array $params = [])
    {
        $twig = $this->container->get('twig');
        
        $path = str_replace('Controller', '', get_class($this));
        $path = trim($path, '\\');
        $path = str_replace('\\', DS, $path);
        
        $template = $path . DS . $template;
        
        if (!file_exists(VIEW_DIR . $template)) {
            throw new \Exception("{$template} not found");
        }
        
        return $twig->render($template, $params);
    }
    
    protected function getRepository($forEntity)
    {
        return $this
            ->container
            ->get('repository_factory')
            ->createRepository($forEntity)
        ;
    }
    
    protected function getRouter()
    {
        return $this
            ->container
            ->get('router')
        ;
    }
}