<?php

// dependency injection

namespace Model\Repository;

use Model\Entity\Category;

class CategoryRepository
{
    /**
     * @var \PDO
     */ 
    private $pdo;
    
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function findAll()
    {
       
    }
}