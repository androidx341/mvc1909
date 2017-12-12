<?php

namespace Model\Repository;

use Model\Entity\Category;

class FeedbackRepository
{
    /**
     * @var \PDO
     */ 
    protected $pdo;
    
    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function save(Feedback $feedback)
    {
        // instert into ...
        // pdo->execute()
    }
}