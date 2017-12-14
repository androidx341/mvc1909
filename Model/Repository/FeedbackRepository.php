<?php

namespace Model\Repository;

use Model\Entity\Feedback;

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
        $sql = 'insert into feedback (email, message) values (:email, :message)';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'email' => $feedback->getEmail(),
            'message' => $feedback->getMessage()
        ]);
    }
}