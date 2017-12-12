<?php

namespace Model\Entity;

class Feedback
{
    private $email;
    
    private $message;
    
    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }
    
    public function getMessage()
    {
        return $this->message;
    }
    
    public function setMessage($message)
    {
        $this->message = $message;
        
        return $this;
    }
}