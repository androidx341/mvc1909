<?php

namespace Framework;

abstract class BaseController
{
    protected function render($template, array $params = [])
    {
        extract($params);
        // [
        //     'books' => 123,
        //     'test' => 3345
        // ]
        
        // =>> $books = 123
        // $test = 3345
        $folder =  str_replace(['Controller', '\\'], '',  get_class($this));
        ob_start();
        
        require VIEW_DIR . $folder . DS . $template;
        
        return ob_get_clean();
    }
}