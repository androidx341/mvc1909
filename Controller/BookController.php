<?php

namespace Controller;

use Framework\BaseController;
use Framework\Request;
use Model\Repository\BookRepository;

class BookController extends BaseController
{
    private $pdo;
    private $repository;
    
    public function __construct(\PDO $pdo)
    {   
        $this->pdo = $pdo;
        $this->repository = new BookRepository();
        $this->repository->setPdo($pdo);
        // devionity: $this->model = new BookModel();
    }
    
    public function indexAction(Request $request)
    {
        //  1. Active Record => Book.php (id, title, ... + save, findbyid, findall)
        //  2. Data Mapper => Book.php (id, title,...) + Mapper or Repository (save, findById, findAll, ...) 
        
        $books = $this->repository->findAllBooks();
        
        var_dump($books);
        
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
    
    public function showAction(Request $request)
    {
        return $this->render('show.phtml');
    }
}