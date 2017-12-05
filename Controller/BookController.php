<?php

namespace Controller;

use Framework\BaseController;

class BookController extends BaseController
{
    public function indexAction()
    {
        // get db connection
        // fetch books
        // render template
        $books = [
            'book 1',
            'book 2'
        ];
        
        $test = 123;
        
        return $this->render('index.phtml', [
            'books' => $books, 
            'a' => $test
        ]);
    }
    
    public function showAction()
    {
        return $this->render('show.phtml');
    }
}