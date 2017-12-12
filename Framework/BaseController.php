<?php

namespace Framework;

abstract class BaseController
{
    protected $container;
    
    public function setContainer(Container $container)
    {
        $this->container = $container;
        
        return $this;
    }
    
    protected function render($template, array $params = [])
    {
        extract($params);
        // get folder path 
        $folder =  str_replace(['Controller', '\\'], '',  get_class($this));
        $template = VIEW_DIR . $folder . DS . $template;
        
        if (!file_exists($template)) {
            throw new \Exception("{$template} not found");
        }
        
        ob_start();
        require $template;
        $content = ob_get_clean();
        
        ob_start();
        require VIEW_DIR . 'layout.phtml';
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
}