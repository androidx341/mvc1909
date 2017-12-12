<?php

namespace Model\Form\FeedbackForm;

class FeedbackForm
{
    public $email;
    public $message;
    
    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
    }
    
    public function isValid()
    {
        return !empty($this->email) && !empty($this->message);
    }
}