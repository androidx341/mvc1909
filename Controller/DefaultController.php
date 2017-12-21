<?php

namespace Controller;

use Framework\BaseController;
use Framework\Request;
use Framework\Session;
use Model\Form\FeedbackForm;
use Model\Entity\Feedback;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->render('index.html.twig', ['a' => '<b>1</b>']);
    }
    
    public function feedbackAction(Request $request)
    {
        $form = new FeedbackForm(
            $request->post('email'),  // $_POST['email']
            $request->post('message')
        );
        
        if ($request->isPost()) {
            if ($form->isValid()) {
                
                $feedback = new Feedback(
                    $form->email,
                    $form->message
                );
                
                $this->getRepository('Feedback')->save($feedback);
                
                Session::setFlash('Saved');
                
                $this
                    ->getRouter()
                    ->redirect('/index.php?controller=Default&action=feedback')
                ;
            }
            
            Session::setFlash('Form invalid');
        }
        
        return $this->render('feedback.html.twig', [
            'form' => $form
        ]);
    }
}