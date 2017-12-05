<?php

namespace Controller;

use Framework\BaseController;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        return $this->render('index.phtml');
    }
    
    public function feedbackAction()
    {
        return $this->render('feedback.phtml');
    }
}