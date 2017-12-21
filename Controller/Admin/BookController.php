<?php

namespace Controller\Admin;

use Framework\BaseController;
use Framework\Request;
use Framework\Exception\NotFoundException;
use Model\Repository\BookRepository;

class BookController extends BaseController
{
    const BOOKS_PER_PAGE = 50;
    
    public function indexAction(Request $request)
    {
       return $this->render('index.html.twig');
    }
    
    public function editAction(Request $request)
    {
        
    }
    
    public function createAction(Request $request)
    {
        
    }
    
    public function deleteAction(Request $request)
    {
        
    }
}