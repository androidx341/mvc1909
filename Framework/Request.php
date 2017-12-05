<?php

namespace Framework;

class Request
{
    private $post;
    private $get;
    private $files;
    
    public function __construct(array $get = [], array $post = [], array $files = [])
    {
        $this->get = $get;
        $this->post = $post;
        $this->files = [];
        
        foreach ($files as $file) {
            $uploadedFile = new UploadedFile();
            $this->files[] = $uploadedFile;
        }
        
    }
    
    public function post($key)
    {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        }
        
        return null;
    }
    
    public function get($key)
    {
        if (isset($this->get[$key])) {
            return $this->get[$key];
        }
        
        return null;
    }
    
    public function isPost()
    {
        return (bool) $this->post;
    }
}