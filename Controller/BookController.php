<?php

namespace Controller;

use Framework\BaseController;
use Framework\Request;
use Framework\Exception\NotFoundException;
use Model\Repository\BookRepository;

class BookController extends BaseController
{
    const BOOKS_PER_PAGE = 12;
    
    public function indexAction(Request $request)
    {
        $books = $this
            ->getRepository('Book') // 'Book'Repository object
            ->findAll()
        ;
        
        return $this->render('index.html.twig', [
            'books' => $books, 
        ]);
    }
    
    public function showAction(Request $request)
    {
        $id = $request->get('id'); // $_GET['id']
        $book = $this
            ->getRepository('Book')
            ->find($id)
        ;
        
        if (!$book) {
            throw new NotFoundException('Book not found');
        }
        
        return $this->render('show.html.twig', [
            'book' => $book
        ]);
    }
}