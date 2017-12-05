<?php

namespace Framework;

// todo
class UploadedFile
{
    private $name;
    private $size;
    // ...
    
    public function isImage()
    {
        // return $this->type ... ?
    }
    
    public function generateFilename()
    {
        // extension ??
        return md5(uniqid());
    }
    
    public function upload()
    {
        // move_uploaded_file()
    }
}