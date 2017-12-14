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
        extract($params);
        
        $path = str_replace('Controller', '', get_class($this));
        $path = trim($path, '\\');
        $path = str_replace('\\', DS, $path);
        
        $template = VIEW_DIR . $path . DS . $template;
        
        if (!file_exists($template)) {
            throw new \Exception("{$template} not found");
        }
        
        ob_start();
        require $template;
        $content = ob_get_clean();
        
        ob_start();
        require VIEW_DIR . $this->layout;
        return ob_get_clean();
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