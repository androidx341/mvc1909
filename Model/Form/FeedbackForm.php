<?php

namespace Model\Form;

class FeedbackForm
{
    public $email;
    public $message;
    
    public function __construct($email = null, $message = null)
    {
        $this->email = $email;
        $this->message = $message;
    }
    
    public function isValid()
    {
        return !empty($this->email) && !empty($this->message);
    }
}