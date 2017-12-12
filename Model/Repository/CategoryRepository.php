<?php

// dependency injection

namespace Model\Repository;

use Model\Entity\Category;

class CategoryRepository
{
    /**
     * @var \PDO
     */ 
    protected $pdo;
    
    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function findAll()
    {
       
    }
}