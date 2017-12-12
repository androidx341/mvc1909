<?php

namespace Controller;

use Framework\BaseController;
use Framework\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->render('index.phtml');
    }
    
    public function feedbackAction(Request $request)
    {
        // $_POST['user'] --> $request->post('user')
        
        // if ($_POST) {
            // if (valid()) {
                // 
                
                // Router::redirect - bad idea
                // $this->container->get('router')->redirect('http://...');
            // }
        // }
        
        return $this->render('feedback.phtml');
    }
}