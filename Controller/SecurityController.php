<?php

namespace Controller;

use Framework\BaseController;
use Framework\Request;
use Framework\Session;
use Model\Form\LoginForm;

class SecurityController extends BaseController
{
    public function loginAction(Request $request)
    {
        $form = new LoginForm(
            $request->post('email'),
            $request->post('password')
        );
        
        if ($request->isPost()) {
            if ($form->isValid()) {
                $user = $this
                    ->getRepository('User')
                    ->findByEmail($form->email)
                ;
                
                if (!$user) {
                     $this->reloadPageWithFlash('User not found');
                }
                
                if (password_verify($form->password, $user->getPassword())) {
                    Session::set('user', $user->getEmail());
                    $this
                        ->getRouter()
                        ->redirect('/index.php?controller=Admin\Default')
                    ;
                }
                
                $this->reloadPageWithFlash('User not found');
            }
        }
        
        return $this->render('login.html.twig', [
            'form' => $form
        ]);
    }
    
    public function logoutAction()
    {
        Session::remove('user');
        $this->getRouter()->redirect('/');
    }
    
    public function registerAction()
    {
        // save user to DB
    }
    
    public function resetAction()
    {
        // 
    }
    
    public function activateAction()
    {
        
    }
    
    // todo: move to BaseController, use $_SERVER[REQUEST_URI]
    private function reloadPageWithFlash($flash)
    {
        Session::setFlash($flash);
        $this
            ->getRouter()
            ->redirect('/index.php?controller=Security&action=login')
        ;
    }
}